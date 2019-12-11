<?php

namespace App\Repositories\System;

use App\Events\SendSMS;
use App\Models\System\Sms;
use App\Validators\System\SmsValidator;
use Ixudra\Curl\Facades\Curl;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\System\SmsRepository;

/**
 * Class SmsRepositoryEloquent.
 */
class SmsRepositoryEloquent extends BaseRepository implements SmsRepository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Sms::class;
    }

    /**
     * Specify Validator class name.
     *
     * @return mixed
     */
    public function validator()
    {
        return SmsValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria.
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @return string
     */
    public function presenter()
    {
        return 'Prettus\\Repository\\Presenter\\ModelFractalPresenter';
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function sendSms()
    {
        $type = request('type') ?? 1;//1 登录模板  2  提现模板 3  更换密码 4 更换手机号
        $phone = request('phone');
        if (! preg_match("/^1[3456789]{1}\d{9}$/", $phone)) {
            return json(4001, '手机号格式不正确');
        }
        $token = rand(100000, 999999);
        //聚合短信配置
        $setting = setting();
        if ($setting->sms['default'] == 'feige'){
            $market = $setting->sms['feige'];
            $data = [
                'Account' => $market['account'],
                'Pwd' => $market['Pwd'],
                'Content' => $token,
                'Mobile' => $phone,
                'TemplateId' => $market['TemplateId'],
                'SignId' => $market['SignId'],
            ];
            Curl::to('http://api.feige.ee/SmsService/Template')
                ->withData($data)
                ->asJsonResponse()
                ->post();
        }else{
            if ($setting->sms['default'] == 'juhe'){
                $market = $setting->sms['juhe'];
            }else{
                $market = $setting->sms['aliyun'];
            }

            if ($type == 2){
                $template = isset($market['withdraw_id']) ? $market['withdraw_id'] : $market['id'];
            }elseif ($type == 3){
                $template = isset($market['password_id']) ? $market['password_id'] : $market['id'];
            }elseif ($type == 4){
                $template = isset($market['phone_id']) ? $market['phone_id'] : $market['id'];
            }else{
                $template = $market['id'];
            }
            event(new SendSMS($phone, $template, $token));
        }
        Sms::query()->create([
            'phone' => $phone,
            'code' => $token,
        ]);
        cache(['withdrawSms_'.$phone=>$token], now()->addMinutes(env('VERIFY_CODE_EXPIRED_TIME',60)));

        return json(1001, '短信发送成功');
    }
}

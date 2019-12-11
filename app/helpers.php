<?php

/**
 * Global helpers file with misc functions.
 */

use Hashids\Hashids;

if (!function_exists('db')) {

    /**
     * @param $table
     * @return \Illuminate\Database\Query\Builder
     */
    function db($table)
    {
        return \Illuminate\Support\Facades\DB::table($table);
    }
}

if (!function_exists('storage')) {

    /**
     * @param $disk
     * @return \Illuminate\Contracts\Filesystem\Filesystem|\Illuminate\Filesystem\FilesystemAdapter
     */
    function storage($disk = null)
    {
        return \Illuminate\Support\Facades\Storage::disk($disk);
    }
}

if (!function_exists('checkPermission')) {
    /**
     * @param $table
     * @param $id
     * @param $field
     * @throws Exception
     */
    function checkPermission($table, $id, $field)
    {
        $obj = \Illuminate\Support\Facades\DB::table($table)->find($id);
        if (!$obj) {
            throw new \Exception('非法参数！');
        }
        //不是总管理员
        if (!getUser()->hasRole('superAdmin')) {
            if ($obj->$field != getUserId()) {
                throw new \Exception('没有权限！');
            }
        }
    }
}


if (!function_exists('json')) {
    /**
     * @param int $code 状态码
     * @param string $message 状态描述
     * @param null $data 返回数据
     * @param int $statusCode
     * @param boolean $numberCheck
     * @return \Illuminate\Http\JsonResponse
     */
    function json(int $code, string $message, $data = null, $statusCode = 200, $numberCheck = false)
    {
        $array = [
            'code' => $code,
            'msg'  => $message,
            'data' => []
        ];

        if ($data != null) {
            $array['data'] = $data;
        }
        if(!$numberCheck){
            return response()->json($array, $statusCode);
        }

        return response()->json($array, $statusCode,[],JSON_NUMERIC_CHECK);
    }
}

if (!function_exists('listJson')) {
    /**
     * @param int $code
     * @param string $message
     * @param int $count
     * @param null $data
     * @param int $statusCode
     * @param bool $numberCheck
     * @return \Illuminate\Http\JsonResponse
     */
    function listJson(int $code, string $message,int $count, $data = null, $statusCode = 200, $numberCheck = false)
    {
        $array = [
            'code'  => $code,
            'msg'   => $message,
            'count' => $count,
        ];

        if ($data != null) {
            $array['data'] = $data;
        }else{
            $array['data'] = [];
        }
        if(!$numberCheck){
            return response()->json($array, $statusCode);
        }

        return response()->json($array, $statusCode,[],JSON_NUMERIC_CHECK);
    }
}

if (!function_exists('include_route_files')) {
    /**
     * Loops through a folder and requires all PHP files
     * Searches sub-directories as well.
     *
     * @param $folder
     */
    function include_route_files($folder)
    {
        try {
            $rdi = new recursiveDirectoryIterator($folder);
            $it  = new recursiveIteratorIterator($rdi);
            while ($it->valid()) {
                if (!$it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                    require $it->key();
                }
                $it->next();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

if (!function_exists('getUserId')) {

    /**
     * @return int|mixed
     */
    function getUserId()
    {
        return auth('api')->id();
    }
}
if (!function_exists('getAdminUser')) {

    /**
     * @return int|mixed
     */
    function getAdminUser()
    {
        return auth('admin')->user();
    }
}
if (!function_exists('getToken')) {

    /**
     * @return int|mixed
     */
    function getToken()
    {
        return request('token');
    }
}

if (!function_exists('checkSms')) {

    /**
     * 验证短信是否过期
     * @param $phone
     * @param $code
     * @return bool
     */
    function checkSms($phone, $code)
    {
        $model = \App\Models\System\Sms::where([
            'code' => $code,
            'phone' => $phone,
            ['created_at', '>=', now()->addSecond(-env('VERIFY_CODE_EXPIRED_TIME',60))->toDateTimeString()],
        ])->first();

        if (!$model) {
            return false;
        }

        return true;
    }
}

if (!function_exists('checkEmail')) {

    /**
     * @param $email
     * @param $code
     * @return bool.
     */
    function checkEmail($email, $code)
    {
        $model = \App\Models\System\Email::where([
            'code' => $code,
            'email' => $email,
            ['created_at', '>=', now()->addSecond(-env('VERIFY_CODE_Email_EXPIRED_TIME',60))->toDateTimeString()],
        ])->first();

        if (!$model) {
            return false;
        }

        return true;
    }
}

if (!function_exists('setting')) {
    /**
     * @return mixed
     */
    function setting()
    {
        $setting = (new \App\Models\System\Setting())->first();

        return $setting;
    }
}


if (!function_exists('HashCode')){
    /**
     * 哈希
     * @return Hashids
     */
    function HashCode(){
        $hash = new Hashids(config('hashids.SALT'), config('hashids.LENGTH'), config('hashids.ALPHABET'));
        return $hash;
    }

}

if (!function_exists('getUser')) {

    /**
     * @return int|mixed
     */
    function getUser()
    {
        return auth('api')->user();
//        return $user = \App\Models\User\User::query()->find(102);
    }
}

if (!function_exists('intercept')){
    /**
     * 截取
     * @param $commission_amount
     * @param int $limit
     * @return bool|string
     */
    function intercept($commission_amount, $limit=3){
        $offset = strpos($commission_amount, '.');
        if ($offset !== false) {
            $commission_amount = substr($commission_amount, 0, $offset + $limit);
        }
        return $commission_amount;
    }
}

if (! function_exists('setOrder')) {
    /**
     * @return string
     * 设置订单号
     */
    function setOrder() {
        list($t1, $t2) = explode(' ',microtime());
        $t3 = explode('.',$t1*10000);
        $orderSn = $t2.$t3[0].rand(10000,99999);
        return $orderSn;
    }
}








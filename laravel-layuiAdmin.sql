/*
 Navicat Premium Data Transfer

 Source Server         : 本地
 Source Server Type    : MySQL
 Source Server Version : 50553
 Source Host           : localhost:3306
 Source Schema         : daledou

 Target Server Type    : MySQL
 Target Server Version : 50553
 File Encoding         : 65001

 Date: 11/12/2019 11:32:43
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin_users
-- ----------------------------
DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '用户名',
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '密码',
  `ip` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '最后登录ip',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nickname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '昵称',
  `remark` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '介绍',
  `is_isable` tinyint(3) NULL DEFAULT 2 COMMENT '是否禁用  1 是 2 否',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 23 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '后台用户' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_users
-- ----------------------------
INSERT INTO `admin_users` VALUES (1, 'admin', '$2y$10$XkA7Ty4WGY5ZbRn1oEF6H.Gvevn7USV7ibq4UNuF1heE6QWbPUuYm', '127.0.0.1', '2019-11-13 16:56:02', '2019-12-11 10:32:52', '与昂', 'perfect', 2);
INSERT INTO `admin_users` VALUES (3, 'admin1', '$2y$10$XkA7Ty4WGY5ZbRn1oEF6H.Gvevn7USV7ibq4UNuF1heE6QWbPUuYm', '127.0.0.1', '2019-11-13 16:56:02', '2019-11-20 09:54:28', '与昂', 'perfect', 2);
INSERT INTO `admin_users` VALUES (21, 'adminadmin', '$2y$10$ParaqHz9w8uXm0gGUplN8.qdmHvyJ6LEPrCbID9p3cNRSC6Y8mDzK', NULL, '2019-11-19 17:20:01', '2019-11-19 17:39:30', '阿达萨达', NULL, 1);
INSERT INTO `admin_users` VALUES (22, 'text', '$2y$10$NAzeUMSJkjNW05BfFBmQ4eb3HkhubYGyb2R4QVq4jalNkA/wVDu4G', NULL, '2019-11-20 09:12:02', '2019-11-20 09:12:02', 'text', NULL, 2);

-- ----------------------------
-- Table structure for articles
-- ----------------------------
DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '标题',
  `category_id` int(11) NULL DEFAULT NULL COMMENT '文章分类id',
  `sort` int(11) NULL DEFAULT NULL COMMENT '排序',
  `thump_nail` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT '缩略图',
  `thump` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT '封面图',
  `key_word` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT '关键词',
  `summary` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL COMMENT '文章摘要',
  `content` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL COMMENT '文章内容',
  `is_show` tinyint(3) NULL DEFAULT NULL COMMENT '是否展示 1 是 2 否',
  `is_recommend` tinyint(3) NULL DEFAULT NULL COMMENT '是否推荐 1 是 2 否',
  `is_review` tinyint(3) NULL DEFAULT NULL COMMENT '是否审核 1 是 2 否',
  `release_time` timestamp NULL DEFAULT NULL COMMENT '发布时间',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `author_id` int(11) NULL DEFAULT NULL COMMENT '发布人id',
  `volume` int(11) NULL DEFAULT NULL COMMENT '浏览量',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = '文章' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of articles
-- ----------------------------
INSERT INTO `articles` VALUES (1, '第三方sdfsdf是都', 1, 0, 'sdf', 'sdf', 'sdf', 'sdf', 'sdf', 1, 2, 1, '2019-11-18 00:00:00', '2019-11-18 15:30:28', '2019-11-18 17:08:44', 1, 101);
INSERT INTO `articles` VALUES (2, '第三方', 2, 0, 'sdf', 'sdf', 'sdf', 'sdf', 'sdf', 2, 1, 2, '2019-11-18 00:00:00', '2019-11-18 15:30:28', '2019-11-18 15:30:28', 1, 10);
INSERT INTO `articles` VALUES (3, '第三方', 8, 0, 'sdf', 'sdf', 'sdf', 'sdf', 'sdf', 1, 2, 1, '2019-11-18 00:00:00', '2019-11-18 15:30:28', '2019-11-18 15:30:28', 1, 10);
INSERT INTO `articles` VALUES (6, '第四方', 8, 0, 'sdf', 'sdf', 'sdf', 'sdf', 'sdf', 2, 1, 2, '2019-11-18 00:00:00', '2019-11-18 15:30:28', '2019-11-18 15:30:28', 1, 10);
INSERT INTO `articles` VALUES (7, '第三方', 1, 0, 'sdf', 'sdf', 'sdf', 'sdf', 'sdf', 1, 2, 1, '2019-11-18 00:00:00', '2019-11-18 15:30:28', '2019-11-18 15:30:28', 1, 10);
INSERT INTO `articles` VALUES (9, '第三方', 8, 0, 'sdf', 'sdf', 'sdf', 'sdf', 'sdf', 1, 2, 1, '2019-11-18 00:00:00', '2019-11-18 15:30:28', '2019-11-18 15:30:28', 1, 10);
INSERT INTO `articles` VALUES (11, '第三方', 2, 0, 'sdf', 'sdf', 'sdf', 'sdf', 'sdf', 1, 2, 2, '2019-11-18 00:00:00', '2019-11-18 15:30:28', '2019-11-18 15:30:28', 1, 10);

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '分类名',
  `sort` tinyint(3) NULL DEFAULT NULL COMMENT '排序',
  `is_show` tinyint(3) NULL DEFAULT NULL COMMENT '是否显示 1 是 2 否',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = '文章分类' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES (1, '新闻咨询', 1, 1, '2019-11-18 14:46:04', '2019-11-18 14:46:04');
INSERT INTO `category` VALUES (2, '帮助中心', 2, 1, '2019-11-18 14:46:04', '2019-11-18 14:46:04');
INSERT INTO `category` VALUES (8, '关于我们', 3, 1, '2019-11-18 14:46:04', '2019-11-18 14:46:04');

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED NULL DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `jobs_queue_index`(`queue`(250)) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '队列' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NULL DEFAULT NULL COMMENT '父id',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '菜单名称',
  `sort` tinyint(3) NULL DEFAULT NULL COMMENT '排序',
  `group` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '分组',
  `is_show` tinyint(3) NULL DEFAULT NULL COMMENT '是否隐藏 1 是 2 否',
  `is_developer` tinyint(3) NULL DEFAULT NULL COMMENT '是否开发者模式可见 1 是 2 否',
  `describe` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '详细说明',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '路由',
  `icon` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '图标',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 53 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '菜单' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES (19, 4, '文章列表', 9, NULL, 1, 2, NULL, '2019-11-19 11:54:05', '2019-11-19 11:54:05', 'article', 'layui-icon-read');
INSERT INTO `menus` VALUES (16, 7, '后台管理员', 9, NULL, 1, 2, 'as', '2019-11-19 11:44:01', '2019-11-19 11:44:01', 'adminUserList', 'layui-icon-friends');
INSERT INTO `menus` VALUES (17, 6, '网站用户', 9, NULL, 1, 2, '下场', '2019-11-19 11:52:50', '2019-11-19 11:52:50', 'userList', 'layui-icon-username');
INSERT INTO `menus` VALUES (52, 23, '微信配置', 5, NULL, 1, 2, NULL, '2019-12-11 10:59:15', '2019-12-11 10:59:15', 'wechat', 'layui-icon-login-wechat');
INSERT INTO `menus` VALUES (4, 0, '新闻管理', 88, NULL, 1, 2, '新闻', '2019-11-14 10:14:29', '2019-11-19 11:57:57', NULL, 'layui-icon-template-1');
INSERT INTO `menus` VALUES (6, 0, '用户', 99, NULL, 1, 2, NULL, '2019-11-14 16:10:48', '2019-11-19 11:57:31', NULL, 'layui-icon-face-smile-b');
INSERT INTO `menus` VALUES (7, 0, '管理员', 66, NULL, 1, 2, 'asdsdf', '2019-11-19 10:24:59', '2019-11-19 10:32:27', NULL, 'layui-icon-group');
INSERT INTO `menus` VALUES (20, 4, '分类管理', 8, NULL, 1, 2, NULL, '2019-11-19 11:55:01', '2019-11-19 11:55:01', 'category', 'layui-icon-list');
INSERT INTO `menus` VALUES (51, 23, '短信设置', 5, NULL, 1, 2, NULL, '2019-12-11 09:58:43', '2019-12-11 09:58:43', 'sms', 'layui-icon-cellphone');
INSERT INTO `menus` VALUES (22, 7, '角色管理', 8, NULL, 1, 2, NULL, '2019-11-19 11:59:00', '2019-11-19 14:51:16', 'role', 'layui-icon-face-surprised');
INSERT INTO `menus` VALUES (23, 0, '系统设置', 33, NULL, 1, 2, NULL, '2019-11-19 11:59:33', '2019-11-19 12:00:29', NULL, 'layui-icon-set-fill');
INSERT INTO `menus` VALUES (24, 0, '我的设置', 55, NULL, 1, 2, NULL, '2019-11-19 11:59:44', '2019-11-19 12:00:17', NULL, 'layui-icon-util');
INSERT INTO `menus` VALUES (25, 23, '网站设置', 9, NULL, 1, 2, NULL, '2019-11-19 12:01:13', '2019-11-19 12:01:13', 'system', 'layui-icon-dollar');
INSERT INTO `menus` VALUES (26, 23, '菜单设置', 8, NULL, 1, 2, NULL, '2019-11-19 12:01:37', '2019-11-19 12:01:50', 'menu', 'layui-icon-add-circle-fine');
INSERT INTO `menus` VALUES (27, 24, '基本资料', 9, NULL, 1, 2, NULL, '2019-11-19 12:02:34', '2019-11-19 12:02:34', 'info', 'layui-icon-tabs');
INSERT INTO `menus` VALUES (28, 24, '修改密码', 8, NULL, 1, 2, NULL, '2019-11-19 12:02:56', '2019-11-19 12:02:56', 'password', 'layui-icon-password');
INSERT INTO `menus` VALUES (42, 41, '币种', 9, NULL, 1, 2, NULL, '2019-11-20 15:02:56', '2019-11-20 15:02:56', 'currency', 'layui-icon-dollar');
INSERT INTO `menus` VALUES (43, 41, '基于币种', 7, NULL, 1, 2, NULL, '2019-11-20 15:03:56', '2019-11-20 15:03:56', 'currencyType', 'layui-icon-read');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '迁移' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (5, '2019_11_15_053347_create_permission_tables', 2);
INSERT INTO `migrations` VALUES (4, '2019_11_15_053522_create_jobs_table', 1);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`(250)) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '重置密码' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 31 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '权限' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES (1, '文章列表', 'admin', '2019-11-19 15:42:11', '2019-11-19 15:42:11');
INSERT INTO `permissions` VALUES (2, '后台管理员', 'admin', '2019-11-19 15:42:11', '2019-11-19 15:42:11');
INSERT INTO `permissions` VALUES (3, '网站用户', 'admin', '2019-11-19 15:42:11', '2019-11-19 15:42:11');
INSERT INTO `permissions` VALUES (6, '新闻管理', 'admin', '2019-11-19 15:42:11', '2019-11-19 15:42:11');
INSERT INTO `permissions` VALUES (7, '用户', 'admin', '2019-11-19 15:42:11', '2019-11-19 15:42:11');
INSERT INTO `permissions` VALUES (8, '管理员', 'admin', '2019-11-19 15:42:11', '2019-11-19 15:42:11');
INSERT INTO `permissions` VALUES (9, '分类管理', 'admin', '2019-11-19 15:42:11', '2019-11-19 15:42:11');
INSERT INTO `permissions` VALUES (29, '短信设置', 'admin', '2019-12-11 09:58:43', '2019-12-11 09:58:43');
INSERT INTO `permissions` VALUES (11, '角色管理', 'admin', '2019-11-19 15:42:11', '2019-11-19 15:42:11');
INSERT INTO `permissions` VALUES (12, '系统设置', 'admin', '2019-11-19 15:42:11', '2019-11-19 15:42:11');
INSERT INTO `permissions` VALUES (13, '我的设置', 'admin', '2019-11-19 15:42:11', '2019-11-19 15:42:11');
INSERT INTO `permissions` VALUES (14, '网站设置', 'admin', '2019-11-19 15:42:11', '2019-11-19 15:42:11');
INSERT INTO `permissions` VALUES (15, '菜单设置', 'admin', '2019-11-19 15:42:11', '2019-11-19 15:42:11');
INSERT INTO `permissions` VALUES (16, '基本资料', 'admin', '2019-11-19 15:42:11', '2019-11-19 15:42:11');
INSERT INTO `permissions` VALUES (17, '修改密码', 'admin', '2019-11-19 15:42:11', '2019-11-19 15:42:11');
INSERT INTO `permissions` VALUES (30, '微信配置', 'admin', '2019-12-11 10:59:15', '2019-12-11 10:59:15');

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions`  (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `role_has_permissions_role_id_foreign`(`role_id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '角色权限关联' ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------
INSERT INTO `role_has_permissions` VALUES (1, 5);
INSERT INTO `role_has_permissions` VALUES (2, 5);
INSERT INTO `role_has_permissions` VALUES (3, 5);
INSERT INTO `role_has_permissions` VALUES (3, 6);
INSERT INTO `role_has_permissions` VALUES (6, 5);
INSERT INTO `role_has_permissions` VALUES (7, 5);
INSERT INTO `role_has_permissions` VALUES (7, 6);
INSERT INTO `role_has_permissions` VALUES (8, 5);
INSERT INTO `role_has_permissions` VALUES (9, 5);
INSERT INTO `role_has_permissions` VALUES (11, 5);
INSERT INTO `role_has_permissions` VALUES (12, 5);
INSERT INTO `role_has_permissions` VALUES (13, 5);
INSERT INTO `role_has_permissions` VALUES (13, 6);
INSERT INTO `role_has_permissions` VALUES (14, 5);
INSERT INTO `role_has_permissions` VALUES (15, 5);
INSERT INTO `role_has_permissions` VALUES (16, 5);
INSERT INTO `role_has_permissions` VALUES (16, 6);
INSERT INTO `role_has_permissions` VALUES (17, 5);
INSERT INTO `role_has_permissions` VALUES (17, 6);
INSERT INTO `role_has_permissions` VALUES (29, 5);
INSERT INTO `role_has_permissions` VALUES (30, 5);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '角色' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (5, '超级管理员', 'admin', '2019-11-19 16:25:25', '2019-12-11 10:59:41');
INSERT INTO `roles` VALUES (6, '代理商', 'admin', '2019-11-19 16:31:09', '2019-11-19 16:31:09');

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings`  (
  `id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sms` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '短信',
  `xieyi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '协议',
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '邮件',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '网站标题',
  `qq` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT 'QQ信息',
  `wechat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '微信信息',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '设置' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO `settings` VALUES ('1', '{\"feige\":{\"account\":\"lv118\",\"Pwd\":\"4f67c606572f1bb54f926ee5c\",\"SignId\":\"203993\",\"TemplateId\":\"117452\",\"TemplateId1\":\"117470\",\"TemplateId2\":\"117461\"},\"aliyun\":{\"access_key\":\"LTAIgs149brZENfx\",\"access_secret\":\"0DxWRSkDQb6OmKnq8PflyOmGC5KsAQ\",\"sign_name\":\"\\u5609\\u6dd8\\u60e0\",\"id\":\"SMS_168410873\"},\"juhe\":{\"app_key\":\"8a80703eb9818e87284477dedceaedf3\",\"id\":\"79720\"},\"default\":\"feige\"}', '用户协议  请仔细阅读本协议，嘉淘惠平台将依据以下条件和条款为您提供服务。 欢迎阅读嘉淘惠平台用户协议(下称“本协议”)。本协议阐述之条款和条件适用于您使用嘉淘惠平台所提供的所有网络服务。请您务必审慎阅读、充分理解各条款内容，若您对本协议有任何不认同，可以选择不加入和使用本平台。 “嘉淘惠”由河南嘉淘惠信息技术有限公司所运营的APP产品，本协议由您与河南嘉淘惠信息技术有限公司共同缔结，具有合同效力。本协议中协议双方合称协议方，河南嘉淘惠信息技术有限公司在协议中亦称为“嘉淘惠”。 一、协议内容及签署 1、本协议内容包括协议正文及所有嘉淘惠已经发布的或将来可能发布的各类规则，包括但不仅限于网站公告及帮助在内的官方声明。所有规则为本协议不可分割的组成部分，与协议正文具有同等法律效力。除另行明确声明外，任何嘉淘惠及其关联公司提供的服务均受本协议约束。但法律法规另有强制性规定的，依其规定。  2、您在注册嘉淘惠账户时点击提交“我已阅读并且同意嘉淘惠的使用协议”即视为您接受本协议及各类规则，并同意受其约束。您应当在使用嘉淘惠服务之前认真阅读全部协议内容并确保完全理解协议内容，如您对协议有任何疑问的，应向嘉淘惠咨询。但无论您事实上是否在使用嘉淘惠服务之前认真阅读了本协议内容，只要您注册、正在或者继续使用嘉淘惠服务，则视为接受本协议，届时您不应以未阅读本协议的内容或对本协议有任何误解为由，主张本协议无效，或要求撤销本协议。  3、您承诺接受并遵守本协议的约定。如果您不同意本协议的约定，您不应当注册成为嘉淘惠的用户，若您正在注册或正在使用嘉淘惠服务，您应立即停止注册程序或停止使用嘉淘惠服务。  4、嘉淘惠有权根据需要不时地制订、修改本协议或各类规则，并以网站公示的方式进行公告，不再单独通知您。变更后的协议和规则一经在网站公布后，立即自动生效，且自动有效代替原来的协议和规则。嘉淘惠的最新的协议和规则以及网站公告可供您随时登陆查阅，您也应当经常性的登陆查阅最新的协议和规则以及网站公告以了解嘉淘惠最新动态。如您不同意相关变更，应当立即停止使用嘉淘惠服务。您继续使用服务的，即表示您接受经修订的协议和规则。  二、用户及账户管理 1、申请资格  您应当是具备完全民事权利能力和完全民事行为能力的自然人、法人或其他组织。若您不具备前述主体资格，则您及您的监护人应承担因此而导致的一切后果，且嘉淘惠有权注销（永久冻结）您的嘉淘惠账户，并向您及您的监护人索偿或者追偿。若您不具备前述主体资格，则需要监护人同意您方可注册成为嘉淘惠用户，否则您和您的监护人应承担因此而导致的一切后果，且嘉淘惠有权注销（永久冻结）您的嘉淘惠账户，并向您及您的监护人索偿或者追偿。 嘉淘惠并无能力对您或您的监护人的民事权利能力和民事行为能力进行实质性审查，因此一旦您进行了注册，嘉淘惠可以视为您具备完全民事权利能力和完全民事行为能力。   2、账户  在您签署本协议，完成用户注册程序或以其他嘉淘惠允许的方式实际使用嘉淘惠服务时，嘉淘惠会向您提供唯一编号的嘉淘惠账户（以下亦称账户）。 您可以对账户设置用户名和密码，通过该用户名密码或与该用户名密码关联的其它第三方用户名密码登陆嘉淘惠平台。您设置的用户名不得侵犯或涉嫌侵犯他人合法权益。若您提供任何违法、不道德或嘉淘惠认为不适合在嘉淘惠上展示的资料；或者嘉淘惠有理由怀疑您的资料属于程序或恶意操作，嘉淘惠有权暂停或终止您的帐号，并拒绝您于现在和未来使用本服务之全部或任何部分。 您应对您的账户（用户名）和密码的安全，以及对通过您的账户（用户名）和密码实施的行为负责。除非经过正当法律程序，且征得嘉淘惠的同意，否则，账户（用户名）和密码不得以任何方式转让、赠与或继承。如果发现任何人不当使用您的账户或有任何其他可能危及您的账户安全的情形时，您应当立即以有效方式通知嘉淘惠，要求嘉淘惠暂停相关服务。您理解嘉淘惠对您的请求采取行动需要合理时间，嘉淘惠对在采取行动前已经产生的后果（包括但不限于您的任何损失）不承担任何责任，但嘉淘惠未能在合理时间内采取行动的情况除外。您确认并认可您在注册、使用嘉淘惠服务过程中提供、形成的数据等相关信息的所有权及其他相关权利属于嘉淘惠，嘉淘惠有权使用上述信息。  3、用户  当您按照注册页面提示填写信息、阅读并同意本协议并完成全部注册程序后或以其他嘉淘惠允许的方式实际使用嘉淘惠服务时，您即成为嘉淘惠用户（亦称“用户”）。 在您注册时，应当按照法律法规要求，或注册页面的提示提供，并及时更新您准确的个人资料，并保证资料真实、及时、完整和准确。如有合理理由怀疑您提供的资料错误、不实、过时或不完整的，嘉淘惠有权向您发出询问或要求改正的通知，若您未能在嘉淘惠要求的合理期限内回复嘉淘惠的询问或完成改正，嘉淘惠有权做出删除相应资料并暂时停止账户的处理，直至终止对您提供部分或全部嘉淘惠服务，嘉淘惠对此不承担任何责任，您将承担因此产生的任何成本或支出。 您应当准确填写并及时更新您提供的联系电话、联系地址、邮政编码、电子邮件地址等联系方式，以便嘉淘惠或其他用户在需要时与您进行有效联系，因通过这些联系方式无法与您取得联系，导致您在使用嘉淘惠服务过程中产生任何损失或增加费用的，应由您完全独自承担，嘉淘惠对此不予承担。 嘉淘惠无须对您的任何登记资料的真实性、正确性、完整性、适用性及/或是否为最新资料承担任何包括但不限于鉴别、核实的责任。 您在使用嘉淘惠服务过程中，所产生的应纳税费，以及一切硬件、软件、服务、账户维持及其它方面的费用，均由您独自承担。您同意嘉淘惠有权从您相关账户中优先扣除上述费用。 对于被嘉淘惠账户冻结或者暂时停止帐户的用户，嘉淘惠将不再提供用户连锁项目下的服务。  三、嘉淘惠服务 1、嘉淘惠将向您呈现第三方优惠券、交易、广告和其他优惠（以下统称“要约”）。要约是由第三方（以下统称“卖方”）提供的产品和服务。用户选择接受要约，则视为与卖方达成交易。嘉淘惠并非交易相关方，因此不对用户和卖方之间的交易承担任何责任。嘉淘惠不负责履行任何要约。 在用户购买产品或服务或以任何其他方式接受要约之前，请阅读要约的整个描述，包括卖方网站上规定的附属细则和任何额外的条款和条件。用户须基于卖方说明，自行了解所要购买的产品或服务。要约的条款和条件，包括退款和取消交易政策，均按照卖方的政策执行。卖方政策不受嘉淘惠约束。在任何情况下，嘉淘惠不对用户与卖方之间的交易负责。有关要约或用户与卖方之间交易的问题，请直接与卖方联系。  2、嘉淘惠为用户免费提供在线优惠券服务。对于在线优惠券的赎回、错误/疏忽或过期等情形，嘉淘惠不承担任何责任，用户应自行确保卖方结帐过程中是否有折扣、特价或免费赠予等情形。网站和论坛上的所有要约和推广内容如有变更，恕不另行通知。嘉淘惠无法控制卖方提供的任何优惠券或其他要约的合法性、任何卖方按照要约完成销售的能力、以及卖方所提供商品的质量。嘉淘惠无法控制卖方是否会遵守网站和论坛上所示的要约，也无法保证网站信息的准确性和完整性。对于用户就网站和论坛、或网站和论坛上的信息使用与卖方发生的任何争议，用户同意放弃提出索赔、要求、诉讼、损害赔偿（直和间接）、损失赔偿、成本赔偿、或已知和未知或已披露和未披露费用赔偿的权利，并免除嘉淘惠就此所承担的责任。  3、嘉淘惠服务中包括广告，用户同意在使用过程中接收由嘉淘惠及其关联方或其第三方合作伙伴发布的或向用户电子设备发送的广告信息。  四、嘉淘惠使用规范及处理规定 在使用嘉淘惠服务过程中，您承诺遵守下列使用规范：  1、用户承诺其注册信息的正确性。  2、如果用户提供给嘉淘惠的资料有变更，请及时通知嘉淘惠做出相应的修改。  3、用户不得出现恶意注册恶意点击等行为。  4、在使用嘉淘惠服务过程中实施的所有行为均遵守国家法律、法规等规范性文件及嘉淘惠各项规则的规定和要求，不违背社会公共利益或公共道德，不损害他人的合法权益，不违反本协议及相关规则。任何用户不得发布或以其它方式传送包括但不限于含有下列内容之一的信息： * 反对我国宪法、法律法规所规定的； * 危害国家安全，泄露国家秘密，颠覆国家政权，破坏国家统一的； * 损害国家荣誉和利益的； * 煽动民族仇恨、民族歧视、破坏民族团结的； * 破坏国家宗教政策，宣扬邪教和封建迷信的； * 散布谣言，扰乱社会秩序，破坏社会稳定的； * 散布淫秽、色情、赌博、暴力、凶杀、恐怖、吸毒或者教唆犯罪的； * 侮辱或者诽谤他人，侵害他人合法权利的； * 含有虚假、诈骗、有害、胁迫、侵害他人隐私、骚扰、侵害、中伤、粗俗、猥亵、或其它道德上令人反感的内容； * 含有中国法律、法规、规章、条例以及任何具有法律效力之规范所限制或禁止的其它内容的；  5、在与其他用户交易过程中，遵守诚实信用原则，不采取不正当竞争行为，不扰乱网上交易的正常秩序。  6、不对嘉淘惠平台上的任何数据作商业性利用，包括但不限于在未经嘉淘惠事先书面同意的情况下，以复制、传播等任何方式使用嘉淘惠站上展示的资料。  7、嘉淘惠禁止用户在嘉淘惠的合作商城内进行任何形式的推广。  8、您不得使用任何装置、软件或例行程序干预或试图干预嘉淘惠平台的正常运作或正在嘉淘惠上进行的任何交易、活动。您不得采取任何将导致不合理的庞大数据负载加诸嘉淘惠网络设备的行动，否则嘉淘惠将追究您的相关责任，包括但不限于列入嘉淘惠黑名单账户、冻结账户或者注销账户等。如造成嘉淘惠损失或者承担相应法律责任的，嘉淘惠有权要求您赔偿并最终承担相应的责任。  9、您了解并同意嘉淘惠有权作如下处理： （1）嘉淘惠有权对您是否违反上述承诺做出单方认定，并根据单方认定结果适用规则予以处理，这无须征得您的同意。 （2）对于您涉嫌违反承诺的行为对任意第三方造成损害的，您均应当以自己的名义独立承担所有的法律责任，并应确保嘉淘惠免于因此产生损失或增加费用。如嘉淘惠因此承担相应责任或者赔偿相关损失，则您承诺嘉淘惠可以向您追偿，相关责任或损失由您最终承担，相关损失包括合理的律师费用、相关机构的查询费用等。 （3）对于您在嘉淘惠上发布的涉嫌违法或涉嫌侵犯他人合法权利或违反本协议和/或规则的信息，嘉淘惠有权予以删除，且按照规则的规定进行处罚。 （4）对于您在嘉淘惠上实施的行为，包括您未在嘉淘惠上实施但已经对嘉淘惠及其用户产生影响的行为，嘉淘惠有权单方认定您行为的性质及是否构成对本协议和/或规则的违反，并据此作出相应处罚。您应自行保存与您行为有关的全部证据，并应对无法提供充要证据而承担的不利后果。 （5）嘉淘惠并无能力对您的相关注册、登记资料进行实质性审查，因此一旦因您的注册、登记资料的问题导致的相关后果应全部由您自己承担，嘉淘惠对此不承担责任。如果根据法律法规要求嘉淘惠先行承担了相关责任，那么您承诺嘉淘惠有权向您追偿，由您最终承担上述责任。 （6）如您涉嫌违反有关法律或者本协议之规定，使嘉淘惠遭受任何损失，或受到任何第三方的索赔，或受到任何行政管理部门的处罚，您应当赔偿嘉淘惠因此造成的损失及（或）发生的费用，包括合理的律师费用、相关机构的查询费用等。 （7）嘉淘惠上展示的资料（包括但不限于文字、图表、标识、图像、数字下载和数据编辑）均为嘉淘惠或其内容提供者的财产或者权利；嘉淘惠上所有内容的汇编是属于嘉淘惠的著作权；嘉淘惠上所有软件都是嘉淘惠或其关联公司或其软件供应商的财产或者权利，上述知识产权均受法律保护。如您侵犯上述权利，嘉淘惠有权根据规则对您进行处理并追究您的法律责任。 （8）经国家行政或司法机关的生效法律文书确认您存在违法或侵权行为，或者嘉淘惠根据自身的判断，认为您的行为涉嫌违反本协议和/或规则的条款或涉嫌违反法律法规的规定的，则嘉淘惠有权在嘉淘惠上公示您的该等涉嫌违法或违约行为及嘉淘惠已对您采取的措施。  五、特别授权 您完全理解并不可撤销地授予嘉淘惠及其关联公司下列权利：  1、一旦您违反本协议，或与嘉淘惠签订的其他协议的约定，嘉淘惠有权以任何方式通知嘉淘惠关联公司或其合作组织，要求其对您的权益采取限制措施，包括但不限于要求嘉淘惠及关联公司中止、终止对您提供部分或全部服务，且在其经营或实际控制的任何网站公示您的违约情况。  2、一旦您向嘉淘惠或其关联公司或其合作组织作出任何形式的承诺，且相关公司或组织已确认您违反了该承诺，则嘉淘惠有权立即按您的承诺或协议约定的方式对您的账户采取限制措施，包括中止或终止向您提供服务，并公示相关公司确认的您的违约情况。您了解并同意，除非法律法规另有明确要求，嘉淘惠无须就相关确认与您核对事实，或另行征得您的同意，且嘉淘惠无须就此限制措施或公示行为向您承担任何的责任。  3、对于您在注册、登记或者交易中记录的资料及数据信息，您理解并同意授予嘉淘惠及其关联公司或其合作组织独家的、永久的、免费的全球范围内使用并许可他人使用的权利。  六、责任范围和责任限制 1、嘉淘惠平台负责按\"现状\"和\"可得到\"的状态向您提供嘉淘惠平台服务。但嘉淘惠平台对嘉淘惠平台服务不作任何明示或暗示的保证，包括但不限于嘉淘惠平台服务的适用性、有无错误或疏漏、持续性、准确性、可靠性、适用于某一特定用途。同时，嘉淘惠平台也不对嘉淘惠平台服务所涉及的技术及信息的有效性、准确性、正确性、可靠性、质量、稳定、完整和及时性作出任何承诺和保证。嘉淘惠平台仅对自身提供的服务承担责任。嘉淘惠平台对于第三方向用户提供的服务和产品不提供保证也不承担任何责任。  若因第三方原因导致嘉淘惠平台向用户承担责任，可向第三方追偿所有损失。  2、您了解嘉淘惠上的信息系第三方或者其他用户自行发布，且可能存在风险和瑕疵。嘉淘惠仅作为您获取物品或服务信息、物色交易对象、就物品和/或服务的交易进行协商及开展交易的场所，但嘉淘惠无法控制交易所涉及的物品的质量、安全或合法性，商贸信息的真实性或准确性，以及交易各方履行其在贸易协议中各项义务的能力。您应自行谨慎判断确定相关物品及/或信息的真实性、合法性和有效性，并自行承担相关风险。  3、除非法律法规明确要求，或出现以下情况，否则，嘉淘惠没有义务对所有用户的注册数据、商品（服务）信息、交易行为以及与交易有关的其它事项进行事先审查： （1) 嘉淘惠有合理的理由认为特定用户及具体交易事项可能存在重大违法或违约情形。 （2) 嘉淘惠有合理的理由认为用户在嘉淘惠的行为涉嫌违法或不当。  4、嘉淘惠上的商品价格、数量、是否有货等商品信息随时有可能发生变动，嘉淘惠不就此作出特别通知。您知悉并理解由于网站上商品信息数量极其庞大，虽然嘉淘惠会尽合理的最大努力保证您所浏览的商品信息的准确性、迅捷性，但由于众所周知的互联网技术因素等客观原因，嘉淘惠显示的信息可能存在一定的滞后性和差错，由此给您带来的不便或产生相应问题，省钱快报不承担责任。  5、您理解并同意，嘉淘惠不对因下述任一情况而导致您的任何损害赔偿承担责任，包括但不限于利润、商誉、使用、数据等方面的损失或其它无形损失的损害赔偿 (无论嘉淘惠是否已被告知该损害赔偿的可能性)： (1）您对嘉淘惠服务的误解； (2)第三方未经批准的使用您的账户或更改您的数据；您的传输或数据遭到未获授权的存取或变更； (3)任何第三方在本服务中所作之声明或行为；  (4)任何非因嘉淘惠的原因而引起的与嘉淘惠服务有关的其它损失。 您理解并同意，嘉淘惠及其关联公司并非司法机构，嘉淘惠及其关联公司无法保证您和第三方的争议处理结果符合您的期望，也不对争议调处结论承担任何责任。如您因此遭受损失，您同意自行通过法律途径向受益人或者其他相关人员索偿。  6、不论在何种情况下，嘉淘惠均不对由于起义、骚乱、火灾、罢工、暴乱、洪水、风暴、爆炸、战争、政府行为、司法行政机关的命令，以及其它非因嘉淘惠的原因而造成的不能服务或延迟服务承担责任。  七、协议终止 1、您同意，嘉淘惠有权依据本协议决定中止、终止向您提供部分或全部嘉淘惠平台服务，暂时冻结或永久冻结（注销）您的账户，且无须为此向您或任何第三方承担任何责任，但本协议或法律法规另有明确要求的除外。  2、出现以下情况时，嘉淘惠有权直接以注销账户的方式终止本协议： (1) 用户超过一年无登陆记录； (2) 您注册信息中的主要内容不真实或不准确或不及时或不完整； (3) 嘉淘惠终止向您提供服务后，您涉嫌再一次直接或间接或以他人名义注册为嘉淘惠用户的； (4) 本协议（含规则）变更时，您明示并通知嘉淘惠不愿接受新的服务协议的； (5) 其它嘉淘惠认为应当终止服务的情况。  3、您有权向嘉淘惠要求注销您的账户，经嘉淘惠审核同意的，嘉淘惠注销（永久冻结）您的账户，届时，您与嘉淘惠基于本协议的合同关系即终止。  4、您的账户被注销（永久冻结）后，嘉淘惠没有义务为您保留或向您披露您账户中的任何信息，也没有义务向您或第三方转发任何您未曾阅读或发送过的信息。  5、您同意，您与嘉淘惠的合同关系终止后，嘉淘惠及其关联公司或者其合作组织仍享有下列权利： (1) 继续保存并使用您的注册、登记信息、数据及您使用嘉淘惠服务期间的所有交易数据； (2) 您在使用嘉淘惠服务期间存在违法行为或违反本协议和/或规则的行为的，嘉淘惠仍可依据本协议向您主张权利。  八、隐私权政策 1、用户注册并使用嘉淘惠平台，视为授权嘉淘惠平台搜集用户姓名、地址、手机号码、银行卡号等个人信息，并向依法经营的第三方征信机构、金融机构查询、验证嘉淘惠平台用户提供的个人信息的真实性。嘉淘惠平台应在合法必要的范围内，为进行交易及提供嘉淘惠平台服务为目的使用上述信息，并对其提供保密；  2、嘉淘惠平台对希望成为用户的主体没有任何限制，但18岁以下的用户使用嘉淘惠平台服务必须取得监护人的同意；   3、一个帐号仅限一个用户使用，用户必须向嘉淘惠平台提供真实信息，如由于资料提供不正确导致任何不良后果的，嘉淘惠平台不承担任何责任；  4、您理解并同意嘉淘惠平台可能会与第三方合作向用户提供相关的网络服务，在此情况下，如该第三方同意承担与本站同等的保护用户隐私的责任，则本站可将用户的注册资料等提供给该第三方；   5、嘉淘惠平台有权在本协议履行期间及本协议终止后保留用户的注册信息、身份信息及用户再嘉淘惠平台服务期间的全部交易或与交易相关的信息，但不得非法使用该等信息。同时，嘉淘惠平台对上述信息依法承担保密义务。如因嘉淘惠平台故意导致信息泄露而造成用户损失的，嘉淘惠平台应承担与其过错相应的责任。   九、法律适用、管辖与争议解决 1、本协议之效力、解释、变更、执行与争议解决均适用中华人民共和国法律，如无相关法律规定的，则应参照通用国际商业惯例和（或）行业惯例。  2、因本协议产生之争议，应依照中华人民共和国法律予以处理。双方对于争议协商不成的，应当提交河南嘉淘惠信息技术有限公司企业所在地人民法院诉讼解决。  十、其它约定 1、 嘉淘惠平台有可能以公告、短信、邮件、温馨提示等形式，向用户说明用户在使用嘉淘惠平台购买商品/服务时应当履行的本协议所约定的义务之外的其他义务，用户亦应当仔细阅读并全面履行。本协议的任何条款（或条款部分内容）被认定为无效、非法或不可执行的，该条款仅在该禁止和不可执行的范围内无效，而不会致使本条款的其余部分或本协议的其余条款失效。 在适用法律允许的前提下，本协议各方特此同意放弃导致本协议条款在任何方面无效、非法或不可执行的法律条款。上述公告、提示如果与本协议相互冲突或者矛盾的，以上述公告、提示为准；上述公告、提示未涉及的内容，仍适用本协议。  2、嘉淘惠平台将本协议内置于本网站的注册环节，用户在注册的过程中即可查阅、了解本协议，并通过勾选“我已阅读并接受《嘉淘惠用户协议》”表示用户完全同意并接受本协议之约束，或者通过取消勾选“我已阅读并接受《嘉淘惠用户协议》”表示用户不同意本协议。  3、 本协议各条款是可分的，所约定的任何条款如果部分或者全部无效，不影响该条款其他部分及本协议其他条款的法律效力。  在点击接受本协议之前请您再次确认已知悉并完全理解本协议的全部内容。  嘉淘惠在此声明，您通过本软件参加的任何商业活动，与Apple Inc.无关。', '{\"smtp_server\":\"smtp.qq.com\",\"smtp_secure\":\"tls\",\"cache\":\"25\",\"send_email\":\"841779797@qq.com\",\"send_nickname\":\"Demo\",\"emailToken\":\"raomlusjjgnibfej\",\"id\":\"1\",\"title\":\"\\u9a8c\\u8bc1\\u7801\"}', '大乐斗', NULL, '{\"official_account\":{\"app_id\":\"wx226916e54217a6bc\",\"secret\":\"5c92e37aaa78a678fd91934a8dc927c4\",\"token\":\"st33rnk5tzvy2cnlg1ee4d3kbsm35wwl\",\"aes_key\":\"JSmgiTd4igoSZktghJrmXBAVqfBXgbCUhSBmWLswoRe\"},\"payment\":{\"app_id\":\"wxea40f73b9d0fde3e\",\"mch_id\":\"1436882102\",\"key\":\"jh5bhfu3zr5swcbgzfidh0wfb4tiondr\",\"notify_url\":\"https:\\/\\/api.quhouqin.cn\\/api\\/payment\\/wechatNotify\"}}', '2018-11-13 14:31:30', '2019-12-11 11:05:48');

-- ----------------------------
-- Table structure for sms
-- ----------------------------
DROP TABLE IF EXISTS `sms`;
CREATE TABLE `sms`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `app_id` int(11) NULL DEFAULT NULL,
  `phone` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `code` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '发送短信记录' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for user_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `user_has_permissions`;
CREATE TABLE `user_has_permissions`  (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `user_has_permissions_model_type_model_id_index`(`model_type`, `model_id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '用户权限关联' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for user_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `user_has_roles`;
CREATE TABLE `user_has_roles`  (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `user_has_roles_model_type_model_id_index`(`model_type`, `model_id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '用户角色关联' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_has_roles
-- ----------------------------
INSERT INTO `user_has_roles` VALUES (5, 'App\\Models\\User\\AdminUser', 1);
INSERT INTO `user_has_roles` VALUES (6, 'App\\Models\\User\\AdminUser', 3);
INSERT INTO `user_has_roles` VALUES (6, 'App\\Models\\User\\AdminUser', 21);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '密码',
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '手机号',
  `headimgurl` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '头像',
  `id_card` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '身份证号',
  `is_lock` int(1) NULL DEFAULT NULL COMMENT '是否锁定  1 是 2 否',
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '邮箱',
  `nationality` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '国籍',
  `area_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '区号',
  `inviter_id` int(11) NULL DEFAULT NULL COMMENT '邀请人id',
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '昵称',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_wechat` tinyint(3) NULL DEFAULT NULL COMMENT '是否绑定微信 1 是 2 否',
  `is_qq` tinyint(3) NULL DEFAULT NULL COMMENT '是否绑定qq 1 是 2 否',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '前端用户' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, '$2y$10$XkA7Ty4WGY5ZbRn1oEF6H.Gvevn7USV7ibq4UNuF1heE6QWbPUuYm', '18888888888', 'https://wx4.sinaimg.cn/mw1024/5db11ff4gy1fmx4keaw9pj20dw08caa4.jpg', '2147483647121', 1, '123456@qq.com', 'China', '86', NULL, '卡洛斯1', '2019-11-16 11:41:45', '2019-11-18 10:38:54', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;

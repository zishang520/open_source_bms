/*
 Navicat Premium Data Transfer

 Source Server         : 本地
 Source Server Type    : MySQL
 Source Server Version : 50711
 Source Host           : localhost:3306
 Source Schema         : open_source_bms

 Target Server Type    : MySQL
 Target Server Version : 50711
 File Encoding         : 65001

 Date: 24/11/2017 11:11:01
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for os_admin_user
-- ----------------------------
DROP TABLE IF EXISTS `os_admin_user`;
CREATE TABLE `os_admin_user`  (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '管理员用户名',
  `password` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '管理员密码',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '状态 1 启用 0 禁用',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `last_login_time` datetime(0) NULL DEFAULT NULL COMMENT '最后登录时间',
  `last_login_ip` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '最后登录IP',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `username`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '管理员表' ROW_FORMAT = Dynamic;
-- ----------------------------
-- Records of os_admin_user
-- ----------------------------
INSERT INTO `os_admin_user` VALUES (1, 'admin', '$2a$08$TyS97oTxWCFzf4b1Ua2YyuFA16ziwwQ5b4SBXTKvY8kNwBl59KGjq', 1, '2016-10-18 15:28:37', '2017-11-22 15:36:07', '127.0.0.1');

-- ----------------------------
-- Table structure for os_article
-- ----------------------------
DROP TABLE IF EXISTS `os_article`;
CREATE TABLE `os_article`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '文章ID',
  `cid` smallint(5) UNSIGNED NOT NULL COMMENT '分类ID',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '标题',
  `introduction` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '简介',
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '内容',
  `author` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '作者',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '状态 0 待审核  1 审核',
  `reading` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '阅读量',
  `thumb` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '缩略图',
  `photo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '图集',
  `is_top` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否置顶  0 不置顶  1 置顶',
  `is_recommend` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否推荐  0 不推荐  1 推荐',
  `sort` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '排序',
  `create_time` datetime(0) NOT NULL COMMENT '创建时间',
  `publish_time` datetime(0) NOT NULL COMMENT '发布时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '文章表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of os_article
-- ----------------------------
INSERT INTO `os_article` VALUES (1, 1, '测试文章一', '', '<p>测试内容</p>', 'admin', 1, 0, '', NULL, 0, 0, 0, '2017-04-11 14:10:10', '2017-04-11 14:09:45');

-- ----------------------------
-- Table structure for os_article_category
-- ----------------------------
DROP TABLE IF EXISTS `os_article_category`;
CREATE TABLE `os_article_category`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '分类名称',
  `alias` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '导航别名',
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '分类内容',
  `thumb` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '缩略图',
  `icon` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '分类图标',
  `list_template` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '分类列表模板',
  `detail_template` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '分类详情模板',
  `type` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '分类类型  1  列表  2 单页',
  `sort` smallint(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT '排序',
  `pid` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '上级分类ID',
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '路径',
  `create_time` datetime(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '分类表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of os_article_category
-- ----------------------------
INSERT INTO `os_article_category` VALUES (1, '分类一', '', '', '', '', '', '', 1, 0, 0, '0,', '2016-12-22 18:22:24');

-- ----------------------------
-- Table structure for os_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `os_auth_group`;
CREATE TABLE `os_auth_group`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` char(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `updated_at` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '权限组表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of os_auth_group
-- ----------------------------
INSERT INTO `os_auth_group` VALUES (1, 'administrator', '超级管理组', '', 1, '2017-11-22 12:49:18', '2017-11-22 13:17:43');
INSERT INTO `os_auth_group` VALUES (3, 'user', '普通用户', '', 1, '2017-11-22 12:49:18', '2017-11-22 13:17:15');
INSERT INTO `os_auth_group` VALUES (4, 'guest', '访客模式', '啊飒飒', 1, '2017-11-22 12:49:18', NULL);

-- ----------------------------
-- Table structure for os_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `os_auth_group_access`;
CREATE TABLE `os_auth_group_access`  (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`, `role_id`) USING BTREE,
  INDEX `role_user_role_id_foreign`(`role_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '权限组规则表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of os_auth_group_access
-- ----------------------------
INSERT INTO `os_auth_group_access` VALUES (1, 1);
INSERT INTO `os_auth_group_access` VALUES (3, 1);

-- ----------------------------
-- Table structure for os_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `os_auth_rule`;
CREATE TABLE `os_auth_rule`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '规则名称',
  `title` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态',
  `pid` smallint(5) UNSIGNED NOT NULL COMMENT '父级ID',
  `icon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '图标',
  `sort` tinyint(4) UNSIGNED NOT NULL COMMENT '排序',
  `condition` char(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `name`(`name`) USING BTREE,
  INDEX `pid`(`pid`) USING BTREE,
  INDEX `id`(`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 75 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '规则表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of os_auth_rule
-- ----------------------------
INSERT INTO `os_auth_rule` VALUES (1, 'admin/System/default', '系统配置', 1, 1, 0, 'fa fa-gears', 0, '');
INSERT INTO `os_auth_rule` VALUES (2, 'admin/System/site_config', '站点配置', 1, 1, 1, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (3, 'admin/System/update_site_config', '更新配置', 1, 0, 2, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (5, 'admin/Menu/default', '菜单管理', 1, 1, 0, 'fa fa-bars', 0, '');
INSERT INTO `os_auth_rule` VALUES (6, 'admin/Menu/index', '后台菜单', 1, 1, 5, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (7, 'admin/Menu/add', '添加菜单', 1, 0, 6, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (8, 'admin/Menu/save', '保存菜单', 1, 0, 6, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (9, 'admin/Menu/edit', '编辑菜单', 1, 0, 6, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (10, 'admin/Menu/update', '更新菜单', 1, 0, 6, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (11, 'admin/Menu/delete', '删除菜单', 1, 0, 6, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (12, 'admin/Nav/index', '导航管理', 1, 1, 5, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (13, 'admin/Category/index', '栏目管理', 1, 1, 14, 'fa fa-sitemap', 0, '');
INSERT INTO `os_auth_rule` VALUES (14, 'admin/Content/default', '内容管理', 1, 1, 0, 'fa fa-file-text', 0, '');
INSERT INTO `os_auth_rule` VALUES (15, 'admin/Article/index', '文章管理', 1, 1, 14, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (16, 'admin/User/default', '用户管理', 1, 1, 0, 'fa fa-users', 0, '');
INSERT INTO `os_auth_rule` VALUES (17, 'admin/User/index', '普通用户', 1, 1, 16, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (18, 'admin/AdminUser/index', '管理员', 1, 1, 16, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (19, 'admin/AuthGroup/index', '权限组', 1, 1, 16, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (20, 'admin/Category/add', '添加栏目', 1, 0, 13, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (21, 'admin/Category/save', '保存栏目', 1, 0, 13, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (22, 'admin/Category/edit', '编辑栏目', 1, 0, 13, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (23, 'admin/Category/update', '更新栏目', 1, 0, 13, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (24, 'admin/Category/delete', '删除栏目', 1, 0, 13, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (25, 'admin/Article/add', '添加文章', 1, 0, 15, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (26, 'admin/Article/save', '保存文章', 1, 0, 15, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (27, 'admin/Article/edit', '编辑文章', 1, 0, 15, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (28, 'admin/Article/update', '更新文章', 1, 0, 15, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (29, 'admin/Article/delete', '删除文章', 1, 0, 15, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (30, 'admin/Article/toggle', '文章审核', 1, 0, 15, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (31, 'admin/AuthGroup/add', '添加权限组', 1, 0, 19, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (32, 'admin/AuthGroup/save', '保存权限组', 1, 0, 19, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (33, 'admin/AuthGroup/edit', '编辑权限组', 1, 0, 19, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (34, 'admin/AuthGroup/update', '更新权限组', 1, 0, 19, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (35, 'admin/AuthGroup/delete', '删除权限组', 1, 0, 19, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (36, 'admin/AuthGroup/auth', '授权', 1, 0, 19, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (37, 'admin/AuthGroup/update_auth_group_rule', '更新权限组规则', 1, 0, 19, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (39, 'admin/Nav/add', '添加导航', 1, 0, 12, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (40, 'admin/Nav/save', '保存导航', 1, 0, 12, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (41, 'admin/Nav/edit', '编辑导航', 1, 0, 12, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (42, 'admin/Nav/update', '更新导航', 1, 0, 12, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (43, 'admin/Nav/delete', '删除导航', 1, 0, 12, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (44, 'admin/User/add', '添加用户', 1, 0, 17, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (45, 'admin/User/save', '保存用户', 1, 0, 17, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (46, 'admin/User/edit', '编辑用户', 1, 0, 17, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (47, 'admin/User/update', '更新用户', 1, 0, 17, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (48, 'admin/User/delete', '删除用户', 1, 0, 17, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (49, 'admin/AdminUser/add', '添加管理员', 1, 0, 18, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (50, 'admin/AdminUser/save', '保存管理员', 1, 0, 18, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (51, 'admin/AdminUser/edit', '编辑管理员', 1, 0, 18, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (52, 'admin/AdminUser/update', '更新管理员', 1, 0, 18, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (53, 'admin/AdminUser/delete', '删除管理员', 1, 0, 18, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (54, 'admin/Slide/default', '扩展管理', 1, 1, 0, 'fa fa-wrench', 0, '');
INSERT INTO `os_auth_rule` VALUES (55, 'admin/SlideCategory/index', '轮播分类', 1, 1, 54, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (56, 'admin/Slide/index', '轮播图管理', 1, 1, 54, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (57, 'admin/Link/index', '友情链接', 1, 1, 54, 'fa fa-link', 0, '');
INSERT INTO `os_auth_rule` VALUES (58, 'admin/SlideCategory/add', '添加分类', 1, 0, 55, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (59, 'admin/SlideCategory/save', '保存分类', 1, 0, 55, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (60, 'admin/SlideCategory/edit', '编辑分类', 1, 0, 55, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (61, 'admin/SlideCategory/update', '更新分类', 1, 0, 55, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (62, 'admin/SlideCategory/delete', '删除分类', 1, 0, 55, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (63, 'admin/Slide/add', '添加轮播', 1, 0, 56, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (64, 'admin/Slide/save', '保存轮播', 1, 0, 56, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (65, 'admin/Slide/edit', '编辑轮播', 1, 0, 56, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (66, 'admin/Slide/update', '更新轮播', 1, 0, 56, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (67, 'admin/Slide/delete', '删除轮播', 1, 0, 56, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (68, 'admin/Link/add', '添加链接', 1, 0, 57, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (69, 'admin/Link/save', '保存链接', 1, 0, 57, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (70, 'admin/Link/edit', '编辑链接', 1, 0, 57, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (71, 'admin/Link/update', '更新链接', 1, 0, 57, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (72, 'admin/Link/delete', '删除链接', 1, 0, 57, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (73, 'admin/ChangePassword/index', '修改密码', 1, 1, 1, '', 0, '');
INSERT INTO `os_auth_rule` VALUES (74, 'admin/ChangePassword/update_password', '更新密码', 1, 0, 73, '', 0, '');

-- ----------------------------
-- Table structure for os_auth_rule_access
-- ----------------------------
DROP TABLE IF EXISTS `os_auth_rule_access`;
CREATE TABLE `os_auth_rule_access`  (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `permission_role_role_id_foreign`(`role_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '权限组规则表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of os_auth_rule_access
-- ----------------------------
INSERT INTO `os_auth_rule_access` VALUES (1, 1);
INSERT INTO `os_auth_rule_access` VALUES (1, 2);
INSERT INTO `os_auth_rule_access` VALUES (1, 3);
INSERT INTO `os_auth_rule_access` VALUES (1, 5);
INSERT INTO `os_auth_rule_access` VALUES (1, 6);
INSERT INTO `os_auth_rule_access` VALUES (1, 7);
INSERT INTO `os_auth_rule_access` VALUES (1, 8);
INSERT INTO `os_auth_rule_access` VALUES (1, 9);
INSERT INTO `os_auth_rule_access` VALUES (1, 10);
INSERT INTO `os_auth_rule_access` VALUES (1, 11);
INSERT INTO `os_auth_rule_access` VALUES (1, 12);
INSERT INTO `os_auth_rule_access` VALUES (1, 13);
INSERT INTO `os_auth_rule_access` VALUES (1, 14);
INSERT INTO `os_auth_rule_access` VALUES (1, 15);
INSERT INTO `os_auth_rule_access` VALUES (1, 16);
INSERT INTO `os_auth_rule_access` VALUES (1, 17);
INSERT INTO `os_auth_rule_access` VALUES (1, 18);
INSERT INTO `os_auth_rule_access` VALUES (1, 19);
INSERT INTO `os_auth_rule_access` VALUES (1, 20);
INSERT INTO `os_auth_rule_access` VALUES (1, 21);
INSERT INTO `os_auth_rule_access` VALUES (1, 22);
INSERT INTO `os_auth_rule_access` VALUES (1, 23);
INSERT INTO `os_auth_rule_access` VALUES (1, 24);
INSERT INTO `os_auth_rule_access` VALUES (1, 25);
INSERT INTO `os_auth_rule_access` VALUES (1, 26);
INSERT INTO `os_auth_rule_access` VALUES (1, 27);
INSERT INTO `os_auth_rule_access` VALUES (1, 28);
INSERT INTO `os_auth_rule_access` VALUES (1, 29);
INSERT INTO `os_auth_rule_access` VALUES (1, 30);
INSERT INTO `os_auth_rule_access` VALUES (1, 31);
INSERT INTO `os_auth_rule_access` VALUES (1, 32);
INSERT INTO `os_auth_rule_access` VALUES (1, 33);
INSERT INTO `os_auth_rule_access` VALUES (1, 34);
INSERT INTO `os_auth_rule_access` VALUES (1, 35);
INSERT INTO `os_auth_rule_access` VALUES (1, 36);
INSERT INTO `os_auth_rule_access` VALUES (1, 37);
INSERT INTO `os_auth_rule_access` VALUES (1, 39);
INSERT INTO `os_auth_rule_access` VALUES (1, 40);
INSERT INTO `os_auth_rule_access` VALUES (1, 41);
INSERT INTO `os_auth_rule_access` VALUES (1, 42);
INSERT INTO `os_auth_rule_access` VALUES (1, 43);
INSERT INTO `os_auth_rule_access` VALUES (1, 44);
INSERT INTO `os_auth_rule_access` VALUES (1, 45);
INSERT INTO `os_auth_rule_access` VALUES (1, 46);
INSERT INTO `os_auth_rule_access` VALUES (1, 47);
INSERT INTO `os_auth_rule_access` VALUES (1, 48);
INSERT INTO `os_auth_rule_access` VALUES (1, 49);
INSERT INTO `os_auth_rule_access` VALUES (1, 50);
INSERT INTO `os_auth_rule_access` VALUES (1, 51);
INSERT INTO `os_auth_rule_access` VALUES (1, 52);
INSERT INTO `os_auth_rule_access` VALUES (1, 53);
INSERT INTO `os_auth_rule_access` VALUES (1, 54);
INSERT INTO `os_auth_rule_access` VALUES (1, 55);
INSERT INTO `os_auth_rule_access` VALUES (1, 56);
INSERT INTO `os_auth_rule_access` VALUES (1, 57);
INSERT INTO `os_auth_rule_access` VALUES (1, 58);
INSERT INTO `os_auth_rule_access` VALUES (1, 59);
INSERT INTO `os_auth_rule_access` VALUES (1, 60);
INSERT INTO `os_auth_rule_access` VALUES (1, 61);
INSERT INTO `os_auth_rule_access` VALUES (1, 62);
INSERT INTO `os_auth_rule_access` VALUES (1, 63);
INSERT INTO `os_auth_rule_access` VALUES (1, 64);
INSERT INTO `os_auth_rule_access` VALUES (1, 65);
INSERT INTO `os_auth_rule_access` VALUES (1, 66);
INSERT INTO `os_auth_rule_access` VALUES (1, 67);
INSERT INTO `os_auth_rule_access` VALUES (1, 68);
INSERT INTO `os_auth_rule_access` VALUES (1, 69);
INSERT INTO `os_auth_rule_access` VALUES (1, 70);
INSERT INTO `os_auth_rule_access` VALUES (1, 71);
INSERT INTO `os_auth_rule_access` VALUES (1, 72);
INSERT INTO `os_auth_rule_access` VALUES (1, 73);
INSERT INTO `os_auth_rule_access` VALUES (1, 74);
INSERT INTO `os_auth_rule_access` VALUES (3, 1);
INSERT INTO `os_auth_rule_access` VALUES (3, 2);
INSERT INTO `os_auth_rule_access` VALUES (3, 3);
INSERT INTO `os_auth_rule_access` VALUES (3, 5);
INSERT INTO `os_auth_rule_access` VALUES (3, 6);
INSERT INTO `os_auth_rule_access` VALUES (3, 7);
INSERT INTO `os_auth_rule_access` VALUES (3, 8);
INSERT INTO `os_auth_rule_access` VALUES (3, 9);
INSERT INTO `os_auth_rule_access` VALUES (3, 10);
INSERT INTO `os_auth_rule_access` VALUES (3, 11);
INSERT INTO `os_auth_rule_access` VALUES (3, 12);
INSERT INTO `os_auth_rule_access` VALUES (3, 13);
INSERT INTO `os_auth_rule_access` VALUES (3, 14);
INSERT INTO `os_auth_rule_access` VALUES (3, 15);
INSERT INTO `os_auth_rule_access` VALUES (3, 16);
INSERT INTO `os_auth_rule_access` VALUES (3, 17);
INSERT INTO `os_auth_rule_access` VALUES (3, 18);
INSERT INTO `os_auth_rule_access` VALUES (3, 19);
INSERT INTO `os_auth_rule_access` VALUES (3, 20);
INSERT INTO `os_auth_rule_access` VALUES (3, 21);
INSERT INTO `os_auth_rule_access` VALUES (3, 22);
INSERT INTO `os_auth_rule_access` VALUES (3, 23);
INSERT INTO `os_auth_rule_access` VALUES (3, 24);
INSERT INTO `os_auth_rule_access` VALUES (3, 25);
INSERT INTO `os_auth_rule_access` VALUES (3, 26);
INSERT INTO `os_auth_rule_access` VALUES (3, 27);
INSERT INTO `os_auth_rule_access` VALUES (3, 28);
INSERT INTO `os_auth_rule_access` VALUES (3, 29);
INSERT INTO `os_auth_rule_access` VALUES (3, 30);
INSERT INTO `os_auth_rule_access` VALUES (3, 31);
INSERT INTO `os_auth_rule_access` VALUES (3, 32);
INSERT INTO `os_auth_rule_access` VALUES (3, 33);
INSERT INTO `os_auth_rule_access` VALUES (3, 34);
INSERT INTO `os_auth_rule_access` VALUES (3, 35);
INSERT INTO `os_auth_rule_access` VALUES (3, 36);
INSERT INTO `os_auth_rule_access` VALUES (3, 37);
INSERT INTO `os_auth_rule_access` VALUES (3, 39);
INSERT INTO `os_auth_rule_access` VALUES (3, 40);
INSERT INTO `os_auth_rule_access` VALUES (3, 41);
INSERT INTO `os_auth_rule_access` VALUES (3, 42);
INSERT INTO `os_auth_rule_access` VALUES (3, 43);
INSERT INTO `os_auth_rule_access` VALUES (3, 44);
INSERT INTO `os_auth_rule_access` VALUES (3, 45);
INSERT INTO `os_auth_rule_access` VALUES (3, 46);
INSERT INTO `os_auth_rule_access` VALUES (3, 47);
INSERT INTO `os_auth_rule_access` VALUES (3, 48);
INSERT INTO `os_auth_rule_access` VALUES (3, 49);
INSERT INTO `os_auth_rule_access` VALUES (3, 50);
INSERT INTO `os_auth_rule_access` VALUES (3, 51);
INSERT INTO `os_auth_rule_access` VALUES (3, 52);
INSERT INTO `os_auth_rule_access` VALUES (3, 53);
INSERT INTO `os_auth_rule_access` VALUES (3, 54);
INSERT INTO `os_auth_rule_access` VALUES (3, 55);
INSERT INTO `os_auth_rule_access` VALUES (3, 56);
INSERT INTO `os_auth_rule_access` VALUES (3, 57);
INSERT INTO `os_auth_rule_access` VALUES (3, 58);
INSERT INTO `os_auth_rule_access` VALUES (3, 59);
INSERT INTO `os_auth_rule_access` VALUES (3, 60);
INSERT INTO `os_auth_rule_access` VALUES (3, 61);
INSERT INTO `os_auth_rule_access` VALUES (3, 62);
INSERT INTO `os_auth_rule_access` VALUES (3, 63);
INSERT INTO `os_auth_rule_access` VALUES (3, 64);
INSERT INTO `os_auth_rule_access` VALUES (3, 65);
INSERT INTO `os_auth_rule_access` VALUES (3, 66);
INSERT INTO `os_auth_rule_access` VALUES (3, 67);
INSERT INTO `os_auth_rule_access` VALUES (3, 68);
INSERT INTO `os_auth_rule_access` VALUES (3, 69);
INSERT INTO `os_auth_rule_access` VALUES (3, 70);
INSERT INTO `os_auth_rule_access` VALUES (3, 71);
INSERT INTO `os_auth_rule_access` VALUES (3, 72);
INSERT INTO `os_auth_rule_access` VALUES (3, 73);
INSERT INTO `os_auth_rule_access` VALUES (3, 74);

-- ----------------------------
-- Table structure for os_link
-- ----------------------------
DROP TABLE IF EXISTS `os_link`;
CREATE TABLE `os_link`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '链接名称',
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '链接地址',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '链接图片',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '状态 1 显示  2 隐藏',
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '排序',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '友情链接表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for os_nav
-- ----------------------------
DROP TABLE IF EXISTS `os_nav`;
CREATE TABLE `os_nav`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pid` int(10) UNSIGNED NOT NULL COMMENT '父ID',
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '导航名称',
  `alias` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '导航别称',
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '导航链接',
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '导航图标',
  `target` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '打开方式',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '状态  0 隐藏  1 显示',
  `sort` int(11) NOT NULL DEFAULT 0 COMMENT '排序',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '导航表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for os_slide
-- ----------------------------
DROP TABLE IF EXISTS `os_slide`;
CREATE TABLE `os_slide`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cid` int(10) UNSIGNED NOT NULL COMMENT '分类ID',
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '轮播图名称',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '说明',
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '链接',
  `target` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '打开方式',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '轮播图片',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '状态  1 显示  0  隐藏',
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '排序',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '轮播图表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for os_slide_category
-- ----------------------------
DROP TABLE IF EXISTS `os_slide_category`;
CREATE TABLE `os_slide_category`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '轮播图分类',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '轮播图分类表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of os_slide_category
-- ----------------------------
INSERT INTO `os_slide_category` VALUES (1, '首页轮播1');

-- ----------------------------
-- Table structure for os_system
-- ----------------------------
DROP TABLE IF EXISTS `os_system`;
CREATE TABLE `os_system`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '配置项名称',
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '配置项值',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '系统配置表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of os_system
-- ----------------------------
INSERT INTO `os_system` VALUES (1, 'site_config', 'a:7:{s:10:\"site_title\";s:30:\"Think Admin 后台管理系统\";s:9:\"seo_title\";s:0:\"\";s:11:\"seo_keyword\";s:0:\"\";s:15:\"seo_description\";s:0:\"\";s:14:\"site_copyright\";s:0:\"\";s:8:\"site_icp\";s:0:\"\";s:11:\"site_tongji\";s:23:\"&lt;div&gt;&lt;/div&gt;\";}');

-- ----------------------------
-- Table structure for os_upload_images
-- ----------------------------
DROP TABLE IF EXISTS `os_upload_images`;
CREATE TABLE `os_upload_images`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `original` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '原始名称',
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '文件名称',
  `file_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '文件类型',
  `hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文件hash',
  `url` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '网路地址',
  `path` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文件全路径地址',
  `size` bigint(20) NOT NULL DEFAULT 0 COMMENT '文件大小',
  `created_at` timestamp(0) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `hash`(`hash`, `file_name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '上传附件' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for os_user
-- ----------------------------
DROP TABLE IF EXISTS `os_user`;
CREATE TABLE `os_user`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户名',
  `password` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '密码',
  `mobile` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '手机',
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '邮箱',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '用户状态  1 正常  2 禁止',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `last_login_time` datetime(0) NULL DEFAULT NULL COMMENT '最后登陆时间',
  `last_login_ip` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '最后登录IP',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `username`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '用户表' ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;

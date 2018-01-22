<?php
namespace app\admin\controller;

use app\common\model\UploadImages;
use think\Controller;
use think\facade\Env;
use think\Request;
use think\facade\Session;

/**
 * 通用上传接口
 * Class Upload
 * @package app\admin\controller
 */
class UploadController extends Controller
{
    protected function initialize()
    {
        parent::initialize();
        if (!Session::has('admin_id')) {
            $result = [
                'error' => 1,
                'message' => '未登录',
            ];
            return abort(json($result));
        }
    }

    /**
     * 通用图片上传接口
     * @return \think\response\Json
     */
    public function upload(Request $request)
    {
        $file = $request->file('file');
        if (empty($file)) {
            return json([
                'error' => 1,
                'message' => '请选择需要上传的图片',
            ]);
        }
        if (!is_object($file)) {
            return json([
                'error' => 1,
                'message' => '文件上传格式错误，只接受单文件上传',
            ]);
        }
        if (!$file->isValid()) {
            return json([
                'error' => 1,
                'message' => '这是一个无效的文件',
            ]);
        }
        if (!$file->validate(['size' => 2097152, 'ext' => 'jpg,gif,png,bmp'])->check()) {
            return json([
                'error' => 1,
                'message' => $file->getError(),
            ]);
        }
        $upload_path = str_replace(DIRECTORY_SEPARATOR, '/', Env::get('root_path') . 'public/uploads');
        $save_path = '/uploads/';
        $upload = new UploadImages();
        $info = $upload->upload($file, $upload_path, $save_path);
        if (!empty($info)) {
            return json([
                'error' => 0,
                'message' => '上传成功',
                'url' => $info->url,
            ]);
        }
        return json([
            'error' => 1,
            'message' => $upload->getError(),
        ]);
    }
}

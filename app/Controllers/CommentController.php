<?php

namespace App\Controllers;

class CommentController extends BaseController
{
    public function index()
    {
        $data = $this->data;
        $data['title'] = 'Manajemen Komentar';

        $builder = $this->db->table('comments')
            ->select('comments.*, posts.title AS post_title, posts.slug AS post_slug')
            ->join('posts', 'posts.id = comments.post_id', 'left')
            ->orderBy('comments.created_at', 'DESC');

        $result = $this->paginateBuilder($builder, 25, 'comments');
        $data['comments'] = $result->data;
        $data['pager'] = $result->pager;

        $data['pending_count'] = $this->db->table('comments')->where('status', 'pending')->countAllResults();
        $data['approved_count'] = $this->db->table('comments')->where('status', 'approved')->countAllResults();
        $data['spam_count'] = $this->db->table('comments')->where('status', 'spam')->countAllResults();

        return view('admin/comments/index', $data);
    }

    public function approve($id)
    {
        $comment = $this->db->table('comments')->where('id', $id)->get()->getRow();
        if ($comment) {
            $this->db->table('comments')->where('id', $id)->update([
                'status'     => 'approved',
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            $this->db->table('activity_logs')->insert([
                'user_id'     => session()->get('id'),
                'username'    => session()->get('username'),
                'module'      => 'Comments',
                'action'      => 'approve',
                'description' => 'Menyetujui komentar dari: ' . $comment->name,
                'ip_address'  => $this->request->getIPAddress(),
                'created_at'  => date('Y-m-d H:i:s'),
            ]);
        }

        return redirect()->to('/admin/comments')->with('success', 'Komentar disetujui.');
    }

    public function spam($id)
    {
        $comment = $this->db->table('comments')->where('id', $id)->get()->getRow();
        if ($comment) {
            $this->db->table('comments')->where('id', $id)->update([
                'status'     => 'spam',
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            $this->db->table('activity_logs')->insert([
                'user_id'     => session()->get('id'),
                'username'    => session()->get('username'),
                'module'      => 'Comments',
                'action'      => 'spam',
                'description' => 'Menandai komentar spam dari: ' . $comment->name,
                'ip_address'  => $this->request->getIPAddress(),
                'created_at'  => date('Y-m-d H:i:s'),
            ]);
        }

        return redirect()->to('/admin/comments')->with('success', 'Komentar ditandai sebagai spam.');
    }

    public function delete($id)
    {
        $comment = $this->db->table('comments')->where('id', $id)->get()->getRow();
        if ($comment) {
            $this->db->table('comments')->where('id', $id)->delete();

            $this->db->table('activity_logs')->insert([
                'user_id'     => session()->get('id'),
                'username'    => session()->get('username'),
                'module'      => 'Comments',
                'action'      => 'delete',
                'description' => 'Menghapus komentar dari: ' . $comment->name,
                'ip_address'  => $this->request->getIPAddress(),
                'created_at'  => date('Y-m-d H:i:s'),
            ]);
        }

        return redirect()->to('/admin/comments')->with('success', 'Komentar berhasil dihapus.');
    }
}

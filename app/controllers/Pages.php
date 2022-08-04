<?php
class Pages extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model("User");
    }

    public function index()
    {
        if (isLoggedIn()) {
            redirect('posts');
        }
        $data = [
            'title' => 'SharePosts',
            'description' => 'Simple social network built on custom PHP framework'
        ];
        $this->view('pages/index', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About',
            'description' => 'App to share posts with other users'
        ];
        $this->view('pages/about', $data);
    }

    public function profile($id)
    {

        $userProfile = $this->userModel->getUserById($id);
        $userPosts = $this->userModel->getUserPosts($id);

        $data = [
            'title' => 'Profile',
            'description' => 'Profile details',
            'user' => $userProfile,
            'posts' => $userPosts
        ];
        $this->view('pages/profile', $data);
    }
}

<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Repositories\BlogRepository;
use App\Http\Requests\StoreBlogRequest;

class BlogsController extends Controller
{
    protected $blogRepository;

    public function __construct(BlogRepository $blogRepository){
        // 需要保证用户在登录状态下才可以发布问题
        // index / show 两个页面无需用户登录也可以浏览
        $this->middleware('auth')->except(['index', 'detail']);
        $this->blogRepository = $blogRepository;
    }

    public function index()
    {
        $blogs = $this->blogRepository->findAllByTime();
        return view('blog.home', compact('blogs'));
    }

    public function create()
    {
        return view('blog.create');
    }

    public function store(StoreBlogRequest $request)
    {
        // 验证规则
        $rules = [
            'title' => 'required|min:6|max:196',        // 标题：必填|最少6个字符|最多196个字符
            'body'  => 'required|min:26'                // 内容：必填|最少26个字符
        ];
        // 把用户提交过来的数据和验证规则传入validate方法中进行验证
        $this->validate($request,$rules);
        $categories = $this->blogRepository->normalizeCategory($request->get('categories'));
        $data = [
            'title' => $request->get('title'),
            'body' => $request->get('body'),
            'user_id' => Auth::id()
        ];

        $this->blogRepository->articleIncrement(Auth::id());
        $blog = $this->blogRepository->createBlog($data);

        $blog->categories()->attach($categories);       // 根据表与表之间的关联关系，给关联表存入数据

        return redirect()->route('blog.show',[$blog->id]);
    }

    public function list() {
        $blogs = $this->blogRepository->findAllByTime();
        return view('blog.list', compact('blogs'));
    }

    public function show($id)
    {
        $blog = $this->blogRepository->findSingleByIdWithCategories($id);

        return view('blog.show',compact('blog'));
    }

    public function detail($id)
    {
        $blog = $this->blogRepository->findSingleByIdWithCategories($id);

        return view('blog.detail',compact('blog'));
    }

    public function edit($id)
    {
        $blog = $this->blogRepository->findSingleById($id);
        return view('blog.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $blog = $this->blogRepository->findSingleById($id);
        $categories = $this->blogRepository->normalizeCategory($request->input('categories'));

        $blog->update([
            'title' => $request->input('title'),
            'body'  => $request->input('body'),
        ]);

        $blog->categories()->sync($categories);

        return redirect()->route('blog.show', [$blog->id]);
    }

    public function destroy($id)
    {
        $this->blogRepository->deleteById($id);
        return redirect()->route('blog.list');
    }
}
<?php

namespace Administrator;

use Repositories\Administrator\UserRepository;
use Repositories\Administrator\RoleRepository;


/**
 * Class UserController
 * @package Administrator
 * @property UserRepository $user
 */
class UserController extends \BaseController
{


    protected $layout = 'admin.layouts.main';
    protected $breadcrumbs = ['Dashboard' => '/', 'Users' => 'user'];
    protected $user;

    public function __construct(UserRepository $user, RoleRepository $role)
    {
        $this->beforeFilter("read_user", array("only" => array("index", "show")));
        $this->beforeFilter("create_user", array("only" => array("create", "store")));
        $this->beforeFilter("update_user", array("only" => array("edit", "update")));
        $this->beforeFilter("update_user", array("only" => array("edit", "update")));
        $this->beforeFilter("delete_user", array("only" => "destroy"));
        $this->user = $user;
        $this->role = $role;
    }

    /**
     * Display a listing of the resource.
     * GET /administrator/user
     *
     * @return Response
     */
    public function index()
    {
        $users = $this->user->getAll();
        $totalUsers = $users->get();
        $users = $users->paginate(10);
        $this->layout->content = \View::make('admin.users.index', compact('users', 'totalUsers'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /administrator/user/create
     *
     * @return Response
     */
    public function create()
    {
        $this->layout->breadcrumbs = $this->breadcrumbs;
        $roles = $this->role->lists();
        $this->layout->content = \View::make('admin.users.create', compact("roles"))->with("title", "Create User");
    }

    /**
     * Store a newly created resource in storage.
     * POST /administrator/user
     *
     * @return Response
     */
    public function store()
    {
        $input = array_except(\Input::all(), ['_method', '_token']);
        $this->user->create($input);
        if ($this->user->succeeded()) {
            return \Redirect::to('user')->with("notice", "User Created");
        } else {
            return \Redirect::back()->withInput()->withErrors($this->user->errors());
        }
    }

    /**
     * Display the specified resource.
     * GET /administrator/user/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * GET /administrator/user/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->user->findById($id);
        $this->layout->breadcrumbs = $this->breadcrumbs;
        $roles = $this->role->lists();
        $this->layout->content = \View::make('admin.users.edit', compact('roles', 'user'))->with("title", "Edit User");
    }

    /**
     * Update the specified resource in storage.
     * PUT /administrator/user/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $data = array_except(\Input::all(), array());
        $this->user->update($id, $data);
        if ($this->user->succeeded()) {
            return \Redirect::to("user")->with("notice", "User Updated");
        } else {
            return \Redirect::back()->withInput()
                ->withErrors($this->user->errors());
        }
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /administrator/user/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        if ($this->user->delete($id)) {
            return \Redirect::to('user')->with('notice', 'User was deleted successfully');
        } else {
            return \Redirect::back()->withErrors($this->user->errors());
        }
    }

}
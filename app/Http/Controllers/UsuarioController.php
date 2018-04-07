<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UsuarioRequest; 
use Datatables;
use App\Rol;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('usuario.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Rol::all();
        return view('usuario.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Request\UsuarioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioRequest $request)
    {
        User::create($request->all());
        return redirect()->route('usuario.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user    = User::FindOrFail($id);
        $roles   = Rol::all();
        //dd($roles);
        $estados = array(1=>"Activo",2=>"Inactivo");
        return view("usuario.edit",compact('user','roles','estados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsuarioRequest $request, $id)
    {

        if(!empty($request->password)){
            User::FindOrFail($id)->update(
                [
                    'name'      => $request->name,
                    'usuario'   => $request->usuario,
                    'apellidos' => $request->apellidos,
                    'email'     => $request->email,
                    'idrol'     => $request->idrol,
                    'estado'    => $request->estado,
                    'password'  => bcrypt($request->password) 
                ]
            );
        }else{
            User::FindOrFail($id)->update(
                [
                    'name'      => $request->name,
                    'usuario'   => $request->usuario,
                    'apellidos' => $request->apellidos,
                    'email'     => $request->email,
                    'idrol'     => $request->idrol,
                    'estado'    => $request->estado
                ]
            );
        }
        
        return redirect()->route('usuario.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getalldata(){


        //dd(User::with('rol')->get());

        return Datatables::of(User::with('rol')->get() )
            ->addColumn('roluser',function($usuario){
                if($usuario->rol){
                    return $usuario->rol->rol ;    
                }else
                    return "";
                
            })
            ->addColumn('edit',function($usuario){
                return '<a href="'.route('usuario.edit',$usuario->id).'" class="btn btn-primary btn-xs">Editar</a>' ;
            })
            ->addColumn('estadouser',function($usuario){
                if($usuario->estado == 1){
                    return "<label class='label label-primary'>Activo</label>";
                }
                else
                    return "<label class='label label-warning'>Inactivo</label>";
            })

            ->rawColumns(['edit','estadouser'])
            ->make(true);

    }
}

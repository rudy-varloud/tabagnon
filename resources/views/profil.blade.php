<!--View qui sert à voir son profil.-->
@extends('layouts.master')
@section('content')

<div class="container">
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >

            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">{{$unV->prenomVis}} {{$unV->nomVis}}</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center"> <img  src="{{URL::asset('assets/image/user.png')}}" class="img-circle img-responsive"> </div>


                        <div class=" col-md-9 col-lg-9 "> 
                            <table class="table table-user-information">
                                <tbody>

                                    <tr>
                                        <td>Adresse</td>
                                        <td>{{$unV->adresseVis}}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{$unV->mailVis}}</a></td>
                                    </tr>
                                <td>Numero de telephone</td>
                                <td>0{{$unV->telVis}}<br>
                                </td>

                                </tr>

                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <a href="{{url( '/modifierProfil') }}"><button  type="submit"data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i> Editer profil</button></a>
                    <a href="{{url( '/getLogout') }}"data-original-title="Se deconnecter" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-off"> </span> Se deconnecter</a>
                </div>

            </div>
        </div>
    </div>
</div>
@stop
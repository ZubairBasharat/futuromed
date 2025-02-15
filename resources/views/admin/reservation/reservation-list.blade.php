@extends('admin.layouts.default')
@section('content')
    <x-admin.response-message />
    <div class="card mb-4 overflow-hidden">
        <div class="card-header justify-content-between d-flex align-items-center">
            <h5 class='mb-0'>Reservations</h5>
            <div class='d-flex align-items-center'>
                <input type="text" class="form-control me-3" placeholder="Search...">    
                <a class="btn btn-primary flex-shrink-0 d-inline-flex align-items-center" href="{{ route('admin.medications.add') }}" role="button">
                    <i class='cil-plus me-2'></i>Add Reserve
                </a>  
            </div>
        </div>
        <div class='card-body p-0'>
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th scope="col" class="align-middle">User</th>
                        <th scope="col" class="align-middle">Email</th>
                        <th scope="col" class="align-middle">Service</th>
                        <th scope="col" class="align-middle">Date</th>
                        <th scope="col" class="align-middle">Status</th>
                        <th scope="col" class="align-middle text-center" colspan="2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $res)
                    <tr>
                        <td class="align-middle">{{ $res->user->nombre }} {{ $res->user->apellido }}</td>
                        <td class="align-middle">
                          {{ $res->user->email }}
                        </td>
                        <td class="align-middle">
                          {{ $res->servicio }}
                        </td>
                        <td class="align-middle">
                          {{$res->fecha_reserva}}
                        </td>
                        <td class="align-middle"><span class="badge {{$res->estado =='pendiente'? '' : 'text-white'}} rounded-pill text-bg-{{$res->estado =='pendiente'? 'warning' : 'success'}}">{{$res->estado =="pendiente"? 'Pending' : 'Confirmed'}}</span></td>
                        <td colspan="2" class="align-middle">
                            <div class='d-flex align-items-center justify-content-center'>
                                <a class="text-decoration-none me-3 text-secondary fs-5" href="#"  data-coreui-toggle="tooltip" data-coreui-placement="top" title="Attachments">
                                    <i class="cil-paperclip"></i>
                                </a>
                                <a class="text-decoration-none position-relative me-3 text-secondary fs-5" href="{{ route('admin.prescriptions', ['pres' => $res->id]) }}"  data-coreui-toggle="tooltip" data-coreui-placement="top" title="Prescription">
                                    <i class="cil-notes"></i>
                                    <small class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary" style="font-size: 12px; line-height: 0.8;">
                                        {{ $res->getPrescriptionCount() }}
                                    </small>
                                </a>
                                <a class="text-decoration-none me-3  text-secondary fs-5" href="{{ route('admin.medications.add', ['type' => 'edit']) }}"  data-coreui-toggle="tooltip" data-coreui-placement="top" title="Edit">
                                    <i class="cil-pencil"></i>
                                </a>
                                <a class="text-decoration-none me-3 text-secondary fs-5" href="#"  data-coreui-toggle="tooltip" data-coreui-placement="top" title="Cancel">
                                    <i class="cil-x"></i>
                                </a>
                                <a class="text-decoration-none text-danger fs-5" href="{{route('admin.reservations.destroy', ['res' => $res->id])}}" data-coreui-toggle="tooltip" data-coreui-placement="top" title="Delete">
                                    <i class="cil-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    <x-admin.not-found-tr :cols="5" :items="$reservations" />
                </tbody>
            </table>
        </div>
        <div class='card-footer border-top-0'>
            <x-admin.pagination-summary :items="$reservations" />
        </div>
    </div>
@endsection
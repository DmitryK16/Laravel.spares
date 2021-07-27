@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Новый товар</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Новый товар</h3>
                        </div>
                        <!-- /.card-header -->

                        <form role="form" method="post" action="{{ route('cards.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Название</label>
                                    <input type="text" name="title"
                                           class="form-control @error('title') is-invalid @enderror" id="title"
                                           placeholder="Название">
                                </div>
                                <div class="form-group">
                                    <label for="description">Описание</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                              id="description"
                                              name="description" placeholder="Описание ..." rows="7"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="manufacturer_id">Производитель</label>
                                    <select class="form-control @error('manufacturer_id') is-invalid @enderror" id="manufacturer_id" name="manufacturer_id">
                                        {{--<option>Select manufacturer</option>--}}
                                         @foreach($manufacturers as $k => $v)
                                             <option value="{{ $k }}">{{ $v }}</option>
                                         @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="groups_id">Группа</label>
                                    <select class="form-control @error('group_id') is-invalid @enderror" id="group_id" name="group_id">
                                        {{--<option>Select group</option>--}}
                                        @foreach($groups as $k => $v)
                                             <option value="{{ $k }}">{{ $v }}</option>
                                         @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="price">Цена</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="text" name="price" id="price" class="form-control @error('price') is-invalid @enderror" >
                                        <div class="input-group-append">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="wight">Вес</label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="wight" id="wight" class="form-control @error('price') is-invalid @enderror">
                                        <div class="input-group-append">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="thumbnail">Изображения</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="thumbnail" id="thumbnail" class="custom-file-input">
                                            <label class="custom-file-label" for="thumbnail">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </form>

                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

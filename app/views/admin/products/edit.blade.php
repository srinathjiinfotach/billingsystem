<div id="main_wrapper">
        <div class="page_bar clearfix">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="page_title">{{ $product->name }}</h1>
                    <p class="text-muted">Lorem ipsum dolor sit amet&hellip;</p>
                </div>
                <div class="col-md-4 text-right">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                    <a href="<? Redirect::back() ?>" class="btn btn-default">Cancel</a>
                    <a href="javascript:void(0)" class="btn btn-link">Delete</a>
                </div>
            </div>
        </div>
        {{-- Create @section for this--}}
        <nav class="breadcrumbs">
            <ul>
                <li><a href="#">Ecommerce</a></li>
                <li class="sep">\</li>
                <li>Product Edit</li>
            </ul>
        </nav>
        <div class="page_content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                {{ Form::model($product, ['method' => 'PUT', 'id'=>'updateProduct', 'route' => ['product.update', $product->id ]] ) }}
                                @include('admin.products.form')
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>
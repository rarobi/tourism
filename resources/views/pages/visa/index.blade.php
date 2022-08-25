@extends('layouts.app')

@section('content')
    <div class="container margin_60">
        <h3 class="text-center">Visa Requirements</h3><br>
        @if(count($description) > 0)
            @foreach($description as $singleDescrption)
                <p class="about-detail">{!! $singleDescrption->description !!}.</p>
            @endforeach
        @endif
        <div class="row">
            <div style="margin-left:auto;margin-right:auto;" class="col-lg-6">
                <table class="table table-striped cart-list add_bottom_30">
                    <thead style="font-size:10px;">
                    <tr>
                        <th>
                            Country Flag
                        </th>
                        <th>
                            Country Name
                        </th>
                        <th>
                            Document
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($documentList) > 0)
                        @foreach($documentList as $singleDocument)
                            <tr>
                                <td>
                                    <img width="30" height="20" src="{!! $singleDocument->flag_path !!}">
                                </td>
                                <td>
                                    {!! $singleDocument->country_name !!}
                                </td>
                                <td>
                                    <a href="{!! $singleDocument->document_path !!}" target="_blank">Download</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <!-- End col-md-8 -->
        </div>
        <!--End row -->
    </div>
        <!--End container -->
@endsection
@section('footer-script')


@endsection



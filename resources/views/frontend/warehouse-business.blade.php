@extends('layouts.frontend')
@section('title', 'Thông tin Chủ kho')
@section('description','Thông tin Chủ kho')

@section('content')
			<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->
			<div class="page_wrapper">

				<div class="container">

					<ul class="breadcrumbs">
						<li><a href="/">Trang chủ</a></li>
						<li>Danh sách các Chủ kho uy tín</li>
					</ul>
					<div class="row ">
						<main class="col-md-12 col-sm-12">
							
							<div class="warehouse_list">
								@if(count($getAllWareHouse)!=0)
									<?php $i=0 ;$j=0?>
									@foreach($getAllWareHouse as $itemAllWareHouse)
										@if($i==0)<div class="category_product_row" style="background-color: #fff;">@endif
													<!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->
											<div class="col-md-2 col-xs-12 company_cell">

												<div class="product_bestselt">

													<div class="company_image">

														<a href="{{ url('/shop/'.$itemAllWareHouse->id) }}"><img src="@if (!empty($itemAllWareHouse->image_kho)){{url('/').$itemAllWareHouse->image_kho}} @else {{asset('/images/2.png')}} @endif" alt=""></a>

													</div>

													<div class="description">

														<p class="textoverlow"><a href="{{ url('/shop/'.$itemAllWareHouse->id) }}" class="clearfix ">{{$itemAllWareHouse->name_company}}</a></p>
														<div class="kho_info clearfix">
															<a href="#" class="alignleft" style="width: 70px;">
																@if($itemAllWareHouse->level == 1)
																	<img src="{{url('/images')}}/level1.png" alt="">
																@elseif($itemAllWareHouse->level == 2)
																	<img src="{{url('/images')}}/level2.png" alt="">
																@elseif($itemAllWareHouse->level == 3)
																	<img src="{{url('/images')}}/level3.png" alt="">
																@else
																	<img src="{{url('/images')}}/level0.png" alt="">
																@endif
															</a>
															<a href="#" class="alignleft" style="width: 70px;">
																@if($itemAllWareHouse->confirm_kho == 1)
																	<img src="{{url('/images')}}/xacthuc.png" alt="">
																@else
																@endif
															</a>
														</div>
														<div class="clearfix product_info">
				                                        	Danh sách product thường xuyên bán
				                                        </div>
													</div>

												</div>
											</div>
											<?php $i = $i+1;$j=$j+1; ?>
											@if($i>=6|| $j>=count($getAllWareHouse))
												<?php $i=0 ?>
										</div>
										@endif

									@endforeach

									@else
										<br>
									<h2 class="text-center" style="text-align: center">Không tìm thấy dữ liệu</h2>
								@endif
							</div>
						</main>
					</div>
					@if($getAllWareHouse->perPage() != 0)
					<footer class="bottom_box text-center">
						<div class="right_side">

							{!! $getAllWareHouse->render() !!}

						</div>
					</footer>
					@endif
				</div>
			</div>
			@include('admin.partial.modal_requiredlogin')
@endsection
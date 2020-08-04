@extends('web.layouts.master')

@section('content')
    <div class="main_filter bg-light py-5">
        <div class="container">
            <section class="row">
                <div class="col-12">
                    <h2 class="text-front icon-filter mb-5">Filtro</h2>
                </div>

                <div class="col-12 col-md-4">
                    <form action="{{ route('web.filter') }}" method="post" class="w-100 p-3 bg-white mb-5">
                        @csrf
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="search" class="mb-2 text-front">Comprar ou Alugar?</label>
                                <select data-action="{{route('api.search')}}" class="selectpicker" data-index="1" id="search" name="filter_search" title="Escolha...">
                                    <option value="buy" {{ session('sale') ? "selected" : "" }}>Comprar</option>
                                    <option value="rent" {{ session('rent') ? "selected" : "" }}>Alugar</option>
                                </select>
                            </div>

                            <div class="form-group col-12">
                                <label for="category" class="mb-2 text-front">O que você quer?</label>
                                <select data-action="{{route('api.category')}}" class="selectpicker" id="category" name="filter_category" data-index="2" title="Escolha...">
                                    <option value="">Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="form-group col-12">
                                <label for="type" class="mb-2 text-front">Qual o tipo do imóvel?</label>
                                <select data-action="{{route('api.type')}}" title="Escolha..." class="selectpicker input-large" id="type" name="filter_type" data-index="3" multiple data-actions-box="true">
                                    <option value="">Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="form-group col-12">
                                <label for="search_locale" class="mb-2 text-front">Onde você quer?</label>
                                <select data-action="{{route('api.neighborhood')}}" class="selectpicker" name="filter_neighborhood" id="neighborhood" data-index="4" title="Escolha..." multiple data-actions-box="true">
                                    <option value="">Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="form-group col-12">
                                <label for="bedrooms" class="mb-2 text-front">Quartos</label>
                                <select data-action="{{route('api.bedrooms')}}" class="selectpicker" name="filter_bedrooms" data-index="5" id="bedrooms" title="Escolha...">
                                    <option value="">Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="form-group col-12">
                                <label for="bedrooms" class="mb-2 text-front">Suítes</label>
                                <select data-action="{{route('api.suites')}}" class="selectpicker" name="filter_suites" data-index="6" id="suites" title="Escolha...">
                                    <option value="">Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="form-group col-12">
                                <label for="bedrooms" class="mb-2 text-front">Banheiros</label>
                                <select data-action="{{route('api.bathrooms')}}" class="selectpicker" name="filter_bathrooms" data-index="7" id="bathrooms" title="Escolha...">
                                    <option value="">Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="form-group col-12">
                                <label for="bedrooms" class="mb-2 text-front">Garagem</label>
                                <select data-action="{{route('api.garage')}}" class="selectpicker" name="filter_garage" data-index="8" id="garage" title="Escolha...">
                                    <option value="">Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="form-group col-12">
                                <label for="bedrooms" class="mb-2 text-front">Preço Base</label>
                                <select data-action="{{route('api.price.base')}}" class="selectpicker" name="filter_price_min" data-index="9" id="price_min" title="Escolha...">
                                    <option value="">Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="form-group col-12">
                                <label for="bedrooms" class="mb-2 text-front">Preço Limite</label>
                                <select data-action="{{route('api.price.limit')}}" class="selectpicker" name="filter_price_max" data-index="10" id="price_max" title="Escolha...">
                                    <option value="">Selecione o filtro anterior</option>
                                </select>
                            </div>

                            <div class="col-12 text-right mt-3 button_search">
                                <button class="btn btn-front icon-search">Pesquisar</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-12 col-md-8">

                    <section class="row main_properties">
                        @forelse($properties as $property)
                            <div class="col-12 col-md-12 col-lg-6 mb-4">
                                <article class="card main_properties_item">
                                    <div class="img-responsive-16by9">
                                        <a href="{{ route(session('rent') == true || isActive('web.rent') ? 'web.rent.property' : 'web.buy.property', ['slug' => $property->slug]) }}">
                                            <img src="{{ $property->cover() }}" class="card-img-top"
                                                 alt="">
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h2>
                                            <a href="{{ route(session('rent') == true || isActive('web.rent') ? 'web.rent.property' : 'web.buy.property', ['slug' => $property->slug]) }}"
                                               class="text-front">
                                                {{ $property->title  }}
                                            </a>
                                        </h2>
                                        <p class="main_properties_item_category">{{ $property->category }}</p>
                                        <p class="main_properties_item_type"
                                           title="{{ $property->type }} - {{ $property->neighborhood }} ">{{ $property->type }}
                                            - {{ $property->neighborhood }}
                                            <i class="icon-location-arrow icon-notext"></i></p>
                                        <p class="main_properties_price text-front">
                                            @if(session('rent') || isActive('web.rent'))
                                                R$ {{ $property->rent_price }}/mês
                                            @elseif(session('sale') || isActive('web.buy'))
                                                R$ {{ $property->sale_price }}
                                            @elseif($property->sale_price && $property->rent_price)
                                                R$ {{ $property->sale_price }} ou
                                                <br />R$ {{ $property->rent_price }}/mês
                                            @endif
                                        </p>
                                        <a href="{{ route(session('rent') == true || isActive('web.rent') ? 'web.rent.property' : 'web.buy.property', ['slug' => $property->slug]) }}"
                                           class="btn btn-front btn-block">Ver Imóvel</a>
                                    </div>
                                    <div class="card-footer d-flex">
                                        <div class="main_properties_features col-4 text-center">
                                            <img src="{{ asset('frontend/assets/images/icons/bed.png') }}" class="img-fluid"
                                                 alt="">
                                            <p class="text-muted">{{ $property->bedrooms }}</p>
                                        </div>

                                        <div class="main_properties_features col-4 text-center">
                                            <img src="{{ asset('frontend/assets/images/icons/garage.png') }}" class="img-fluid"
                                                 alt="">
                                            <p class="text-muted">{{ $property->garage }}</p>
                                        </div>

                                        <div class="main_properties_features col-4 text-center">
                                            <img src="{{ asset('frontend/assets/images/icons/util-area.png') }}"
                                                 class="img-fluid" alt="">
                                            <p class="text-muted">{{ $property->area_util }} m&sup2;</p>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @empty
                            <div class="col-12 p-5 bg-white">
                                <h2 class="text-front icon-info text-center">Oooops, não encontramos nenhum imóvel para comprar ou aluguel</h2>
                                <p class="text-center">Utilize filtro avançado para encontrar o lar dos seus sonhos </p>
                            </div>
                        @endforelse
                    </section>
                </div>
            </section>
        </div>
    </div>
@endsection

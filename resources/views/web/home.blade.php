@extends('web.layouts.master')

@section('content')
    <div class="main_slide d-none d-sm-block">
        <div class="container" style="height: 100%;">
            <div class="row align-items-center" style="height: 100%;">
                <div class="col-lg-8">
                    <p class="main_slide_content text-white">Encontre o <b>Imóvel ideal</b> para você e <b>sua família</b>
                        morar na praia!</p>
                    <a href="javascript:void(0);" class="btn btn-front btn-lg text-white">Quero <b>Alugar</b>!</a>
                    <a href="javascript:void(0);" class="btn btn-front btn-lg text-white">Quero <b>Comprar</b>!</a>
                </div>
            </div>
        </div>
    </div>

    <div class="main_filter">
        <div class="container my-5">
            <div class="row">
                <form action="" class="form-inline w-100">
                    <div class="form-group col-12 col-sm-6 col-lg-3">
                        <label for="search" class="mb-2"><b>Comprar ou Alugar?</b></label>
                        <select class="selectpicker" id="search" name="search" title="Escolha...">
                            <option value="buy">Comprar</option>
                            <option value="rent">Alugar</option>
                        </select>
                    </div>
                    <div class="form-group col-12 col-sm-6 col-lg-3">
                        <label for="category" class="mb-2"><b>O que você quer?</b></label>
                        <select class="selectpicker" id="category" name="category" title="Escolha...">
                            <option value="">Imóvel Residencial</option>
                            <option value="">Comercial/Industrial</option>
                            <option value="">Terreno</option>
                        </select>
                    </div>

                    <div class="form-group col-12 col-sm-6 mt-sm-2 mt col-lg-3 mt-lg-0">
                        <label for="type" class="mb-2 d-block"><b>Qual o tipo do imóvel?</b></label>
                        <select class="selectpicker input-large" id="type" name="type" multiple data-actions-box="true">
                            <option value="">Casa</option>
                            <option value="">Apartamento</option>
                            <option value="">Terreno</option>
                            <option value="">Sala Comercial</option>
                            <option value="">Galpão</option>
                            <option value="">Casa</option>
                            <option value="">Apartamento</option>
                            <option value="">Terreno</option>
                            <option value="">Sala Comercial</option>
                            <option value="">Galpão</option>
                            <option value="">Casa</option>
                            <option value="">Apartamento</option>
                            <option value="">Terreno</option>
                            <option value="">Sala Comercial</option>
                            <option value="">Galpão</option>
                            <option value="">Casa</option>
                            <option value="">Apartamento</option>
                            <option value="">Terreno</option>
                            <option value="">Sala Comercial</option>
                            <option value="">Galpão</option>
                        </select>
                    </div>
                    <div class="form-group col-12 col-sm-6 mt-sm-2 col-lg-3 mt-lg-0">
                        <label for="search_locale" class="mb-2"><b>Onde você quer?</b></label>
                        <select class="selectpicker" name="bedrooms" id="bedrooms" title="Escolha..." multiple data-actions-box="true">
                            <option value="">Campeche</option>
                            <option value="">Rio Tavares</option>
                            <option value="">Morro das Pedras</option>
                            <option value="">Pântano do Sul</option>
                            <option value="">Matadeiro</option>
                            <option value="">Armação</option>

                            <option value="">Campeche</option>
                            <option value="">Rio Tavares</option>
                            <option value="">Morro das Pedras</option>
                            <option value="">Pântano do Sul</option>
                            <option value="">Matadeiro</option>
                            <option value="">Armação</option>
                            <option value="">Campeche</option>
                            <option value="">Rio Tavares</option>
                            <option value="">Morro das Pedras</option>
                            <option value="">Pântano do Sul</option>
                            <option value="">Matadeiro</option>
                            <option value="">Armação</option>
                        </select>
                    </div>

                    <div class="col-12 mt-3 form_advanced" style="display: none;">

                        <div class="row">
                            <div class="form-group col-12 col-sm-6 mt-sm-2 col-lg-3 mt-lg-0">
                                <label for="bedrooms" class="mb-2"><b>Quartos</b></label>
                                <select class="selectpicker" name="bedrooms" id="bedrooms" title="Escolha...">
                                    <option value="">1</option>
                                    <option value="">2</option>
                                    <option value="">3</option>
                                    <option value="">4+</option>
                                </select>
                            </div>

                            <div class="form-group col-12 col-sm-6 mt-sm-2 col-lg-3 mt-lg-0">
                                <label for="bedrooms" class="mb-2"><b>Suítes</b></label>
                                <select class="selectpicker" name="bedrooms" id="bedrooms" title="Escolha...">
                                    <option value="">0</option>
                                    <option value="">1</option>
                                    <option value="">2</option>
                                    <option value="">3</option>
                                    <option value="">4+</option>
                                </select>
                            </div>

                            <div class="form-group col-12 col-sm-6 mt-sm-2 col-lg-3 mt-lg-0">
                                <label for="bedrooms" class="mb-2"><b>Banheiros</b></label>
                                <select class="selectpicker" name="bedrooms" id="bedrooms" title="Escolha...">
                                    <option value="">1</option>
                                    <option value="">2</option>
                                    <option value="">3</option>
                                    <option value="">4+</option>
                                </select>
                            </div>

                            <div class="form-group col-12 col-sm-6 mt-sm-2 col-lg-3 mt-lg-0">
                                <label for="bedrooms" class="mb-2"><b>Garagem</b></label>
                                <select class="selectpicker" name="bedrooms" id="bedrooms" title="Escolha...">
                                    <option value="">0</option>
                                    <option value="">1</option>
                                    <option value="">2</option>
                                    <option value="">3</option>
                                    <option value="">4+</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="form-group col-12 col-sm-6 mt-sm-2 col-lg-6 mt-lg-0">
                                <label for="bedrooms" class="mb-2"><b>Preço Base</b></label>
                                <select class="selectpicker" name="bedrooms" id="bedrooms" title="Escolha...">
                                    <option value="">A partir de R$ 100.000,00</option>
                                    <option value="">2</option>
                                    <option value="">3</option>
                                    <option value="">4+</option>
                                </select>
                            </div>

                            <div class="form-group col-12 col-sm-6 mt-sm-2 col-lg-6 mt-lg-0">
                                <label for="bedrooms" class="mb-2"><b>Preço Limite</b></label>
                                <select class="selectpicker" name="bedrooms" id="bedrooms" title="Escolha...">
                                    <option value="">Até R$ 1.000.000,00</option>
                                    <option value="">2</option>
                                    <option value="">3</option>
                                    <option value="">4+</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 mt-3">
                        <a href="" class="text-front open_filter">Filtro avançado &downarrow;</a>
                    </div>

                    <div class="col-6 text-right mt-3 button_search">
                        <button class="btn btn-front icon-search">Pesquisar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <section class="main_list_group py-5 bg-light">
        <div class="container">
            <div class="p-4 border-bottom border-front">
                <h1 class="text-center">Ambiente no seu <span class="text-front"><b>estilo</b></span></h1>
                <p class="text-center text-muted mb-0 h4">Encontre o imóvel com a experiência que você quer viver</p>
            </div>

            <div class="main_list_group_item row mt-5 d-flex justify-content-around">
                <article class="main_list_group_items_item col-12 col-md-6 col-lg-4 mb-4">
                    <a href="#">
                        <div class="d-flex align-items-center justify-content-center"
                             style="background: url('{{ asset('frontend/assets/images/home/cobertura_oto_1.jpg')  }}') no-repeat; background-size: cover;">
                            <h2>Cobertura</h2>
                        </div>
                    </a>
                </article>

                <article class="main_list_group_items_item col-12 col-md-6 col-lg-4 mb-4">
                    <a href="#">
                        <div class="d-flex align-items-center justify-content-center"
                             style="background: url({{ asset('frontend/assets/images/home/alto_padrao_1.jpg') }}) no-repeat; background-size: cover;">
                            <h2>Alto Padrão</h2>
                        </div>
                    </a>
                </article>

                <article class="main_list_group_items_item col-12 col-md-6 col-lg-4 mb-4">
                    <a href="#">
                        <div class="d-flex align-items-center justify-content-center"
                             style="background: url('{{ asset('frontend/assets/images/home/de_frente_pro_mar_original.jpg') }}') no-repeat; background-size: cover;">
                            <h2>De frente para o Mar</h2>
                        </div>
                    </a>
                </article>

                <article class="main_list_group_items_item col-12 col-md-6 col-lg-4 mb-4">
                    <a href="#">
                        <div class="d-flex align-items-center justify-content-center"
                             style="background: url({{ asset('frontend/assets/images/home/condominio_fechado_1.jpg') }}) no-repeat; background-size: cover;">
                            <h2>Condomínio Fechado</h2>
                        </div>
                    </a>
                </article>

                <article class="main_list_group_items_item col-12 col-md-6 col-lg-4 mb-4">
                    <a href="#">
                        <div class="d-flex align-items-center justify-content-center"
                             style="background: url('{{ asset('frontend/assets/images/home/compacto_1.jpg') }}') no-repeat; background-size: cover;">
                            <h2>Compacto</h2>
                        </div>
                    </a>
                </article>

                <article class="main_list_group_items_item col-12 col-md-6 col-lg-4 mb-4">
                    <a href="#">
                        <div class="d-flex align-items-center justify-content-center"
                             style="background: url('{{ asset('frontend/assets/images/home/sala_comercial_original.jpg') }}') no-repeat; background-size: cover;">
                            <h2>Lojas e Salas</h2>
                        </div>
                    </a>
                </article>
            </div>
        </div>
    </section>

    <section class="main_properties py-5">
        <div class="container">
            <header class="d-flex justify-content-between align-items-center border-bottom border-front mb-5">
                <h1 class="text-front">À Venda</h1>
                <a href="javascript:void(0)" class="text-front">Ver mais</a>
            </header>

            <div class="row">

                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <article class="card main_properties_item">
                        <div class="img-responsive-16by9">
                            <a href="">
                                <img src="properties/1/5a3571ab-4d76-466f-8246-eff8cb98cedd.jpg" class="card-img-top"
                                     alt="">
                            </a>
                        </div>
                        <div class="card-body">
                            <h2><a href="" class="text-front">Linda Casa no Campeche com vista para o Morro do Lampião</a>
                            </h2>
                            <p class="main_properties_item_category">Imóvel Residencial</p>
                            <p class="main_properties_item_type">Casa - Campeche <i
                                    class="icon-location-arrow icon-notext"></i></p>
                            <p class="main_properties_price text-front">R$ 1.500,00/mês</p>
                            <a href="" class="btn btn-front btn-block">Ver Imóvel</a>
                        </div>
                        <div class="card-footer d-flex">
                            <div class="main_properties_features col-4 text-center">
                                <img src="{{ asset('frontend/assets/images/icons/bed.png') }}" class="img-fluid" alt="">
                                <p class="text-muted">4</p>
                            </div>

                            <div class="main_properties_features col-4 text-center">
                                <img src="{{ asset('frontend/assets/images/icons/garage.png') }}" class="img-fluid" alt="">
                                <p class="text-muted">2</p>
                            </div>

                            <div class="main_properties_features col-4 text-center">
                                <img src="{{ asset('frontend/assets/images/icons/util-area.png') }}" class="img-fluid" alt="">
                                <p class="text-muted">1500 m&sup2;</p>
                            </div>
                        </div>
                    </article>
                </div>

                <div class="d-none d-md-block col-md-6 col-lg-4 mb-4">
                    <article class="card main_properties_item">
                        <div class="img-responsive-16by9">
                            <a href="">
                                <img src="properties/2/a56fc386-3790-4e98-a72c-3b09d24adecd.jpg" class="card-img-top"
                                     alt="">
                            </a>
                        </div>
                        <div class="card-body">
                            <h2><a href="" class="text-front">Linda Casa no Campeche com vista para o Morro do Lampião</a>
                            </h2>
                            <p class="main_properties_item_category">Imóvel Residencial</p>
                            <p class="main_properties_item_type">Casa - Campeche <i
                                    class="icon-location-arrow icon-notext"></i></p>
                            <p class="main_properties_price text-front">R$ 1.500,00/mês</p>
                            <a href="" class="btn btn-front btn-block">Ver Imóvel</a>
                        </div>
                        <div class="card-footer d-flex">
                            <div class="main_properties_features col-4 text-center">
                                <img src="{{ asset('frontend/assets/images/icons/bed.png') }}" class="img-fluid" alt="">
                                <p class="text-muted">4</p>
                            </div>

                            <div class="main_properties_features col-4 text-center">
                                <img src="{{ asset('frontend/assets/images/icons/garage.png') }}" class="img-fluid" alt="">
                                <p class="text-muted">2</p>
                            </div>

                            <div class="main_properties_features col-4 text-center">
                                <img src="{{ asset('frontend/assets/images/icons/util-area.png') }}" class="img-fluid" alt="">
                                <p class="text-muted">1500 m&sup2;</p>
                            </div>
                        </div>
                    </article>
                </div>

                <div class="d-none d-lg-block col-lg-4 mb-4">
                    <article class="card main_properties_item">
                        <div class="img-responsive-16by9">
                            <a href="">
                                <img src="properties/3/667d07e1-c0ac-4e3b-b450-4bc9bcc9bffb.jpg" class="card-img-top"
                                     alt="">
                            </a>
                        </div>
                        <div class="card-body">
                            <h2><a href="" class="text-front">Linda Casa no Campeche com vista para o Morro do Lampião</a>
                            </h2>
                            <p class="main_properties_item_category">Imóvel Residencial</p>
                            <p class="main_properties_item_type">Casa - Campeche <i
                                    class="icon-location-arrow icon-notext"></i></p>
                            <p class="main_properties_price text-front">R$ 1.500,00/mês</p>
                            <a href="" class="btn btn-front btn-block">Ver Imóvel</a>
                        </div>
                        <div class="card-footer d-flex">
                            <div class="main_properties_features col-4 text-center">
                                <img src="{{ asset('frontend/assets/images/icons/bed.png') }}" class="img-fluid" alt="">
                                <p class="text-muted">4</p>
                            </div>

                            <div class="main_properties_features col-4 text-center">
                                <img src="{{ asset('frontend/assets/images/icons/garage.png') }}" class="img-fluid" alt="">
                                <p class="text-muted">2</p>
                            </div>

                            <div class="main_properties_features col-4 text-center">
                                <img src="{{ asset('frontend/assets/images/icons/util-area.png') }}" class="img-fluid" alt="">
                                <p class="text-muted">1500 m&sup2;</p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <section class="main_properties py-5 bg-light">
        <div class="container">
            <header class="d-flex justify-content-between align-items-center border-bottom border-front mb-5">
                <h1 class="text-front">Para Alugar</h1>
                <a href="javascript:void(0)" class="text-front">Ver mais</a>
            </header>

            <div class="row">

                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <article class="card main_properties_item">
                        <div class="img-responsive-16by9">
                            <a href="">
                                <img src="properties/4/3d656134-3760-4c9a-af1a-503301acc0be.jpg" class="card-img-top"
                                     alt="">
                            </a>
                        </div>
                        <div class="card-body">
                            <h2><a href="" class="text-front">Linda Casa no Campeche com vista para o Morro do Lampião</a>
                            </h2>
                            <p class="main_properties_item_category">Imóvel Residencial</p>
                            <p class="main_properties_item_type">Casa - Campeche <i
                                    class="icon-location-arrow icon-notext"></i></p>
                            <p class="main_properties_price text-front">R$ 1.500,00/mês</p>
                            <a href="" class="btn btn-front btn-block">Ver Imóvel</a>
                        </div>
                        <div class="card-footer d-flex">
                            <div class="main_properties_features col-4 text-center">
                                <img src="{{ asset('frontend/assets/images/icons/bed.png') }}" class="img-fluid" alt="">
                                <p class="text-muted">4</p>
                            </div>

                            <div class="main_properties_features col-4 text-center">
                                <img src="{{ asset('frontend/assets/images/icons/garage.png') }}" class="img-fluid" alt="">
                                <p class="text-muted">2</p>
                            </div>

                            <div class="main_properties_features col-4 text-center">
                                <img src="{{ asset('frontend/assets/images/icons/util-area.png') }}" class="img-fluid" alt="">
                                <p class="text-muted">1500 m&sup2;</p>
                            </div>
                        </div>
                    </article>
                </div>

                <div class="d-none d-md-block col-md-6 col-lg-4 mb-4">
                    <article class="card main_properties_item">
                        <div class="img-responsive-16by9">
                            <a href="">
                                <img src="properties/5/39e47814-f0d8-4bb5-8508-1622096d1f4d.jpg" class="card-img-top"
                                     alt="">
                            </a>
                        </div>
                        <div class="card-body">
                            <h2><a href="" class="text-front">Linda Casa no Campeche com vista para o Morro do Lampião</a>
                            </h2>
                            <p class="main_properties_item_category">Imóvel Residencial</p>
                            <p class="main_properties_item_type">Casa - Campeche <i
                                    class="icon-location-arrow icon-notext"></i></p>
                            <p class="main_properties_price text-front">R$ 1.500,00/mês</p>
                            <a href="" class="btn btn-front btn-block">Ver Imóvel</a>
                        </div>
                        <div class="card-footer d-flex">
                            <div class="main_properties_features col-4 text-center">
                                <img src="{{ asset('frontend/assets/images/icons/bed.png') }}" class="img-fluid" alt="">
                                <p class="text-muted">4</p>
                            </div>

                            <div class="main_properties_features col-4 text-center">
                                <img src="{{ asset('frontend/assets/images/icons/garage.png') }}" class="img-fluid" alt="">
                                <p class="text-muted">2</p>
                            </div>

                            <div class="main_properties_features col-4 text-center">
                                <img src="{{ asset('frontend/assets/images/icons/util-area.png') }}" class="img-fluid" alt="">
                                <p class="text-muted">1500 m&sup2;</p>
                            </div>
                        </div>
                    </article>
                </div>

                <div class="d-none d-lg-block col-lg-4 mb-4">
                    <article class="card main_properties_item">
                        <div class="img-responsive-16by9">
                            <a href="">
                                <img src="properties/5/8771b309-8314-4023-89a8-1f1b01165075.jpg" class="card-img-top"
                                     alt="">
                            </a>
                        </div>
                        <div class="card-body">
                            <h2><a href="" class="text-front">Linda Casa no Campeche com vista para o Morro do Lampião</a>
                            </h2>
                            <p class="main_properties_item_category">Imóvel Residencial</p>
                            <p class="main_properties_item_type">Casa - Campeche <i
                                    class="icon-location-arrow icon-notext"></i></p>
                            <p class="main_properties_price text-front">R$ 1.500,00/mês</p>
                            <a href="" class="btn btn-front btn-block">Ver Imóvel</a>
                        </div>
                        <div class="card-footer d-flex">
                            <div class="main_properties_features col-4 text-center">
                                <img src="{{ asset('frontend/assets/images/icons/bed.png') }}" class="img-fluid" alt="">
                                <p class="text-muted">4</p>
                            </div>

                            <div class="main_properties_features col-4 text-center">
                                <img src="{{ asset('frontend/assets/images/icons/garage.png') }}" class="img-fluid" alt="">
                                <p class="text-muted">2</p>
                            </div>

                            <div class="main_properties_features col-4 text-center">
                                <img src="{{ asset('frontend/assets/images/icons/util-area.png') }}" class="img-fluid" alt="">
                                <p class="text-muted">1500 m&sup2;</p>
                            </div>
                        </div>
                    </article>
                </div>

            </div>
        </div>
    </section>
@endsection

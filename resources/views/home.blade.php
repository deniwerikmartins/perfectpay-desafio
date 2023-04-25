<x-home-master>

    @section('content')

        @if(session('invalid_creditCard'))
            <div class="row">
                <div class="alert alert-danger mt-3">
                    <p>
                        {{session('invalid_creditCard')}}
                    </p>
                </div>
            </div>
        @endif

        <div class="container py-5">
            <div class="row mb-4">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-6">Selecione a forma de pagamento</h1>
                </div>
            </div> <!-- End -->
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h5 class="display-6">Valor: R$ {{$value}}</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="card ">
                        <div class="card-header">
                            <div class="bg-white shadow-sm pt-4 pl-2 pr-2 pb-2">
                                <!-- Credit card form tabs -->
                                <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3">
                                    <li class="nav-item"> <a data-toggle="pill" href="#credit-card" class="nav-link active "> <i class="fas fa-credit-card mr-2"></i> Cartão de crédito </a> </li>
                                    <li class="nav-item"> <a data-toggle="pill" href="#boleto" class="nav-link "> <i class="fa-solid fa-file-invoice-dollar"></i> Boleto </a> </li>
                                    <li class="nav-item"> <a data-toggle="pill" href="#pix" class="nav-link "> <i class="fas fa-mobile-alt mr-2"></i> Pix </a> </li>
                                </ul>
                            </div> <!-- End -->
                            <!-- Credit card form content -->
                            <div class="tab-content">
                                <!-- credit card info-->
                                <div id="credit-card" class="tab-pane fade show active pt-3">
                                    <form role="form" method="post" action="{{route('payments.store')}}">
                                        @csrf
                                        <input type="hidden" name="value" value={{$value}}>
                                        <input type="hidden" name="customer_id" value={{$customer->id}}>
                                        <input type="hidden" name="billingType" value="CREDIT_CARD">
                                        <div class="form-group">
                                            <label for="holderName">
                                                <h6>Dono do cartão</h6>
                                            </label>
                                            <input type="text" name="holderName" id="holderName" placeholder="Nome do dono do cartão" required class="form-control ">
                                        </div>
                                        <div class="form-group">
                                            <label for="number">
                                                <h6>Cartão de crédito</h6>
                                            </label>
                                            <div class="input-group">
                                                <input type="text" name="number" id="number" placeholder="Numero de cartão válido" class="form-control " required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text text-muted"> <i class="fab fa-cc-visa mx-1"></i> <i class="fab fa-cc-mastercard mx-1"></i> <i class="fab fa-cc-amex mx-1"></i> </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <label>
                                                        <span class="hidden-xs">
                                                            <h6>Data de validade</h6>
                                                        </span>
                                                    </label>
                                                    <div class="input-group">
                                                        <input type="number" placeholder="MM" name="expiryMonth" class="form-control" required min="1" max="12">
                                                        <input type="number" placeholder="AAAA" name="expiryYear" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group mb-4">
                                                    <label data-toggle="tooltip" title="Código de verificação de três dígitos no verso do seu cartão" id="ccv">
                                                        <h6>CVV <i class="fa fa-question-circle d-inline"></i></h6>
                                                    </label>
                                                    <input type="text" pattern="\d*" maxlength="3" minlength="3" placeholder="123" required class="form-control" name="ccv" id="ccv">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="subscribe btn btn-primary btn-block shadow-sm"> Confirmar pagamento </button>
                                    </form>
                                </div>
                            </div> <!-- End -->
                            <div id="boleto" class="tab-pane fade pt-3">
                                <form action="{{route('payments.store')}}" method="post" role="form">
                                    @csrf
                                    <input type="hidden" name="value" value={{$value}}>
                                    <input type="hidden" name="customer_id" value={{$customer->id}}>
                                    <input type="hidden" name="billingType" value="BOLETO">
                                    <div class="form-group">
                                        <p class="text-center">
                                            <button type="submit" class="subscribe btn btn-primary btn-block shadow-sm"> Pagamento por boleto </button>
                                        </p>
                                    </div>
                                </form>
                            </div> <!-- End -->
                            <div id="pix" class="tab-pane fade pt-3">
                                <form action="{{route('payments.store')}}" method="post" role="form">
                                    @csrf
                                    <input type="hidden" name="value" value={{$value}}>
                                    <input type="hidden" name="customer_id" value={{$customer->id}}>
                                    <input type="hidden" name="billingType" value="PIX">
                                    <div class="form-group">
                                        <p class="text-center">
                                            <button type="submit" class="subscribe btn btn-primary btn-block shadow-sm"> Pagamento por Pix </button>
                                        </p>
                                    </div>
                                </form>
                            </div> <!-- End -->
                            <!-- End -->
                        </div>
                    </div>
                </div>
            </div>

    @endsection

</x-home-master>

<x-home-master>

    @section('content')

        <div class="container py-5">
            <div class="row mb-4">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-6">Pagamento Concluído com sucesso</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mx-auto text-center">
                    @if($response['billingType'] === 'CREDIT_CARD')
                        <div>
                            <p>
                                <h4>Transação paga no cartão de crédito</h4>
                            </p>
                        </div>
                    @endif

                    @if($response['billingType'] === 'BOLETO')
                        <div>
                            <p>
                                <h4>Transação realizada no boleto bancário</h4>
                            </p>
                            <button class="btn btn-success btn-block">
                                <a href="{{$response['invoiceUrl']}}" target="_blank">Visualizar boleto para pagamento</a>
                            </button>
                        </div>
                    @endif

                    @if($response['billingType'] === 'PIX')
                        <div>
                            <p>
                                <h4>Transação realizada por PIX</h4>
                            </p>
                            <p>
                                <h3>QR Code</h3>
                                <img src="data:image/jpeg;base64,{{$QRCode->encodedImage}}" alt="">
                            </p>
                            <p>
                                <h4>Código Copia e Cola</h4>
                                <h6>{{$QRCode->payload}}</h6>
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    @endsection

</x-home-master>

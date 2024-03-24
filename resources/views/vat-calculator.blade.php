@extends('layouts.home')

@section('contents')

    <div class="container-fluid pt-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Vat Calculator</h4>
                        <p class="card-title-desc"></p>
                    </div>
                    <div class="card-body p-4">

                        <div class="row">
                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">
                                        <label for="gross_sum" class="form-label">Gross Sum</label>
                                        <input class="form-control" type="text" placeholder="Ex: 120"
                                               id="gross_sum">
                                    </div>

                                    <div class="mb-3">
                                        <label for="tax_percentage" class="form-label">Tax Percentage</label>
                                        <input class="form-control" type="text" placeholder="Ex: 20"
                                               id="tax_percentage">
                                    </div>

                                    <div class="d-flex gap-3">
                                        <div>
                                            <label for="include">Include VAT</label>
                                            <input type="radio" id="include" name="operation" value="include" checked>

                                        </div>

                                        <div>
                                            <label for="exclude">Exclude VAT</label>
                                            <input type="radio" id="exclude" name="operation" value="exclude">
                                        </div>
                                    </div>


                                </div>
                            </div>


                            <div class="mt-4">
                                <button onclick="calculate()" type="submit" id="submit"
                                        class="text-center btn btn-primary">
                                    Calculate
                                </button>
                            </div>

                            <div id="result" class="mt-4">
                                <p>VAT Amount: <span id="vat_amount"></span></p>
                                <p>Net Amount: <span id="net_amount"></span></p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <script>
        async function calculate() {


            let grossSum = $('#gross_sum').val();
            let taxPercentage = $('#tax_percentage').val();
            let operation = $('input[name="operation"]:checked').val();

            axios.post('/calculate', {
                gross_sum: grossSum,
                operation: operation,
                tax_percentage: taxPercentage
            })
                .then(function(response) {
                    $('#vat_amount').text(response.data.vatAmount);
                    $('#net_amount').text(response.data.netAmount);
                })
                .catch(function(error) {
                    console.error('Error calculating VAT:', error);
                });
        }

    </script>
@endsection

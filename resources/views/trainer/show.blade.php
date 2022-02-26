<div class="card bg-none card-box">
    <div class="row">
        <div class="col-12">
            <table class="footable-details table table-striped table-hover toggle-circle">
                <tbody>
                <tr>
                    <td class="text-dark">{{__('Company')}}</td>
                    <td style="display: table-cell;"> {{ !empty($trainer->branches)?$trainer->branches->name:'' }}</td>
                </tr>
                <tr>
                    <td class="text-dark">{{__('First Name')}}</td>
                    <td style="display: table-cell;">{{$trainer->firstname}}</td>
                </tr>
                <tr>
                    <td class="text-dark">{{__('Last Name')}}</td>
                    <td style="display: table-cell;">{{$trainer->lastname}}</td>
                </tr>
                <tr>
                    <td class="text-dark">{{__('Contact Number')}}</td>
                    <td style="display: table-cell;">{{$trainer->contact}}</td>
                </tr>
                <tr>
                    <td class="text-dark">{{__('Email')}}</td>
                    <td style="display: table-cell;">{{$trainer->email}}</td>
                </tr>
                <tr>
                    <td class="text-dark">{{__('Expertise')}}</td>
                    <td style="display: table-cell;">{{$trainer->expertise}}</td>
                </tr>
                <tr>
                    <td class="text-dark">{{__('Address')}}</td>
                    <td style="display: table-cell;">{{$trainer->address}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <x-slot name="style">
      #chartdiv{
        width: 100%;
        height: 500px;
      }
    </x-slot>
    <div class="py-12">
        <x-alert>
        </x-alert>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="flex w-full border-b border-gray-200">
              <div class="m-4 text-center font-bold text-lg w-full flex">
                <div class="w-5/6">
                  {{$immobile->street." ".$immobile->number.", ".$immobile->complement}} 
                </div> 
                <div class="w-1/6">
                  {{$month}}
                </div>
              </div>
            </div>
            <div class="flex w-full border-b border-gray-200">
              <div class="w-1/2">
                <div id="chartdiv"></div>
              </div>
              <div class="w-1/2 bg-sky-500">
                <div class="grid mt-5 mr-5 grid-flow-rows grid-cols-1 gap-5 font-mono text-white text-sm text-center font-bold leading-6">
                  @foreach ($json as $item)
                    <div class="p-4 rounded-lg shadow-lg bg-blue-400">
                      {{$item->name}}: R${{number_format($item->value, 2, ",", ".")}}
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
            <div class="my-2 mt-4">
              <table id="tableImmobilesFinancial" class="display" style="width:100%">
                  <thead>
                      <tr>
                          <th>Endereço</th>
                          <th>Valor</th>
                          <th>Fatura</th>
                          <th>Vencimento</th>
                          <th>Pago</th>
                          <th>&nbsp;</th>
                          <th>&nbsp;</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($financials as $bill)
                          @php
                              if($bill->value>0)
                                  $valor=$bill->value;
                              else
                                  $valor=$bill->value*-1;
                          @endphp
                          <tr>
                              <td>{{$bill->immobile->street." ".$bill->immobile->number.", ".$bill->immobile->complement}}</td>
                              <td>R$ {{number_format($valor,2,",",".")}}</td>
                              <td>{{$bill->type->name}}</td>
                              <td>
                                @php
                                  if(!empty($bill->due)){
                                    $due=new DateTime($bill->due);
                                    echo $due->format("d/m/Y"); 
                                  }
                                @endphp
                              </td>
                              <td>
                                @php
                                  if(!empty($bill->paid)){
                                    $pago=new DateTime($bill->paid);
                                    echo $pago->format("d/m/Y H:i"); 
                                  }
                                  else{
                                    echo "Em Aberto";
                                  }
                                @endphp
                              </td>
                              @if ($bill->status_id==1)
                                <td><a href="{{route('financial.view', ['id' => $bill->id])}}"><img src="{{ asset('img/info.svg') }}" ></a></td>
                                <td><a href="{{route('financial.delete', ['id' => $bill->id])}}"><img src="{{ asset('img/trash-2.svg') }}" ></a></td>                                  
                              @else
                                <td></td>
                                <td></td>
                              @endif
                          </tr>
                      @endforeach
                  </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>

    <x-slot name="script">      
      <!-- Chart code -->
      am5.ready(function() {
        
        // Create root element
        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
        var root = am5.Root.new("chartdiv");
        
        
        // Set themes
        // https://www.amcharts.com/docs/v5/concepts/themes/
        root.setThemes([
          am5themes_Animated.new(root)
        ]);
        
        
        // Create chart
        // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
        var chart = root.container.children.push(am5percent.PieChart.new(root, {
          layout: root.verticalLayout
        }));
            
        // Create series
        // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
        var series = chart.series.push(am5percent.PieSeries.new(root, {
          valueField: "value",
          categoryField: "name"
        }));

        series.labels.template.set("forceHidden", true);
        series.ticks.template.set("forceHidden", true);
        
        // Set data
        // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
        series.data.setAll(
          @php
              echo json_encode($json);
          @endphp
        );
        
        series.appear(1000, 100);
      
      });

      
      $(document).ready(function() {
          $('#tableImmobilesFinancial').DataTable({
              "scrollX": true
          });
      } );
    </x-slot>
</x-app-layout>

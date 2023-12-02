<?php

namespace App\Http\Livewire\Admin\Charts;

use Livewire\Component;
use App\Models\Procedure;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Asantibanez\LivewireCharts\Models\RadarChartModel;
use Asantibanez\LivewireCharts\Models\TreeMapChartModel;

class Pie extends Component
{
    public $state = ["sin asignar", "asignado", "observado", "revisado", "aprobado", "rechazado"];
    public $colors = ["sin asignar" => '#f6ad55', "asignado" => '#fc8181', "observado" => '#90cdf4', "revisado" => '#66DA26', "aprobado" => '#cbd5e0', "rechazado" => '#66DA26'];

    public $firstRun = true;
    public $showDataLabels = false;

    protected $listeners = [
      'onPointClick' => 'handleOnPointClick',
      'onSliceClick' => 'handleOnSliceClick',
      'onColumnClick' => 'handleOnColumnClick',
      'onBlockClick' => 'handleOnBlockClick',
    ];

    public function handleOnPointClick($point)
    {
        dd($point);
    }

    public function handleOnSliceClick($slice)
    {
        dd($slice);
    }

    public function handleOnColumnClick($column)
    {
        dd($column);
    }

    public function handleOnBlockClick($block)
    {
        dd($block);
    }

    public function render()
    {
        $procedures = Procedure::All();

        $pieChartModel = $procedures->groupBy('area_id')->reduce(function ($pieChartModel, $data) {
        $state = $data->first()->area->name;
        $value = $data->count('area_id');
        return $pieChartModel->addSlice($state, $value, sprintf("#%06x", rand(0, 16777215)));
        } , LivewireCharts::pieChartModel()
          ->setAnimated($this->firstRun)
          ->legendPositionBottom()
          ->legendHorizontallyAlignedCenter()
          ->setDataLabelsEnabled($this->showDataLabels)
        );
        
        return view('livewire.admin.charts.pie')->with(['pieChartModel' => $pieChartModel]);
    }
}

<?php

namespace App\Http\Livewire\Admin\Charts;

use Livewire\Component;
use App\Models\Procedure;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Asantibanez\LivewireCharts\Models\RadarChartModel;
use Asantibanez\LivewireCharts\Models\TreeMapChartModel;

class Column extends Component
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

        $columnChartModel = $procedures->groupBy('state')->reduce(function ($columnChartModel, $data) {
          $state = $data->first()->state;
          $value = $data->count('state');
          return $columnChartModel->addColumn($state, $value, $this->colors[$state]);
         } , LivewireCharts::columnChartModel()
          ->setAnimated($this->firstRun)
          ->withOnColumnClickEventName('onColumnClick')
          ->setLegendVisibility(false)
          ->setDataLabelsEnabled($this->showDataLabels)
          ->setColumnWidth(50)
          ->withGrid()
        );

        return view('livewire.admin.charts.column')->with(['columnChartModel' => $columnChartModel]);
    }
}
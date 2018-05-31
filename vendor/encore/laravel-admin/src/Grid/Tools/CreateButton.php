<?php

namespace Encore\Admin\Grid\Tools;

use Encore\Admin\Grid;

class CreateButton extends AbstractTool
{
    /**
     * Create a new CreateButton instance.
     *
     * @param Grid $grid
     */
    public function __construct(Grid $grid)
    {
        $this->grid = $grid;
    }

    /**
     * Render CreateButton.
     *
     * @return string
     */
    public function render()
    {
        if (!$this->grid->allowCreation()) {
            return '';
        }

        $new = trans('admin.new');
        if(!empty($this->grid->option('urlCreate'))){
            $url = $this->grid->option('urlCreate');
        }else{
            $url = $this->grid->resource().'/create';
        }
        return <<<EOT

<div class="btn-group pull-right" style="margin-right: 10px">
    <a href="{$url}" class="btn btn-sm btn-success">
        <i class="fa fa-save"></i>&nbsp;&nbsp;{$new}
    </a>
</div>

EOT;
    }
}

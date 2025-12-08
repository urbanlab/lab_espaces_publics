<?php

declare(strict_types=1);

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class EventFields extends Field
{
    public function fields(): array
    {
        $group = new FieldsBuilder('event_fields', [
            'title' => __('Événement', 'labeps-theme'),
            'style' => 'default',
            'position' => 'side',
            'menu_order' => 0,
            'show_in_rest' => 1,
        ]);

        $group
            ->setLocation('post_type', '==', 'events');

        $group
            ->addDatePicker('event_datetime', [
                'label' => __('Date de l\'événement', 'labeps-theme'),
                'display_format' => 'd/m/Y',
                'return_format' => 'Y-m-d',
                'first_day' => 1,
                'required' => 1,
            ]);

        return $group->build();
    }
}

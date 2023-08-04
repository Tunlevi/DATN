<?php

namespace App\Http\Resources;

use App\Models\Vote;
use Illuminate\Http\Resources\Json\ResourceCollection;

class VoteCollection extends ResourceCollection
{
    public $collects = Vote::class;
    public function toArray($request)
    {
        return [
            'votes' => $this->mapCollection(),
            'meta'   => [
                'total'        => $this->total(),
                'count'        => $this->count(),
                'per_page'     => $this->perPage(),
                'current_page' => $this->currentPage(),
                'total_pages'  => $this->lastPage()
            ],
        ];
    }

    public function mapCollection()
    {
        $votes = $this->collection;
        $data         = [];
        foreach ($votes as $vote) {
            $item                          = $vote;
            $data[]                        = $item;
        }
        return $data;
    }
}

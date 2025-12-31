<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function getAttribute(Request $request)
    {
        $payload = $request->input();

        $attributes = Attribute::query()
            ->where('status', 1)
            ->when(!empty($payload['option']['attributeCatalogueId']), function ($query) use ($payload) {
                $query->where('attribute_catalogue_id', $payload['option']['attributeCatalogueId']);
            })
            ->when(!empty($payload['search']), function ($query) use ($payload) {
                $query->where('name', 'like', '%' . $payload['search'] . '%');
            })
            ->get();
        $attributeMapped = $attributes->map(function ($attribute) {
            return [
                'id' => $attribute->id,
                'text' => $attribute->name,
            ];
        })->all();

        return response()->json(['items' => $attributeMapped]);
    }

    public function loadAttribute(Request $request)
    {
        $attributeEncoded = $request->input('attribute');
        $attributeCatalogueId = $request->input('attributeCatalogueId');
        if (!$attributeEncoded || !$attributeCatalogueId) {
            return response()->json(['error' => __("Missing required parameters")], 400);
        }

        $decoded = json_decode(base64_decode($attributeEncoded), true);
        if (is_string($decoded)) {
            $decoded = json_decode($decoded, true);
        }

        \Log::info('Base64 decoded attribute:', ['decoded' => $decoded]);

        if (!is_array($decoded)) {
            return response()->json(['error' => __("Invalid attribute data")], 400);
        }

        if (!isset($decoded[$attributeCatalogueId])) {
            return response()->json(['error' => __("Attribute Catalogue ID not found")], 400);
        }

        $attributeArray = $decoded[$attributeCatalogueId];
        if (!is_array($attributeArray)) {
            return response()->json(['error' => _ - ("Attribute data is not an array")], 400);
        }

        $attributes = [];
        if (count($attributeArray)) {
            $attributes = $this->findAttributeByIdArray($attributeArray);
        }

        $temp = [];
        foreach ($attributes as $val) {
            $temp[] = [
                'id' => $val->id,
                'text' => $val->name,
            ];
        }
        return response()->json(['items' => $temp]);

    }

    private function findAttributeByIdArray(array $attributeArray = [])
    {
        if (empty($attributeArray)) {
            return collect();
        }

        return Attribute::select(['id', 'attribute_catalogue_id', 'name'])
            ->where('status', 1)
            ->whereIn('id', $attributeArray)
            ->get();
    }
}

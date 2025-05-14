<?

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProdukResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'nama'      => $this->nama,
            'deskripsi' => $this->deskripsi,
            'harga'     => $this->harga,
            'dibuat'    => $this->created_at->toDateTimeString(),
            'diubah'    => $this->updated_at->toDateTimeString(),
        ];
    }
}

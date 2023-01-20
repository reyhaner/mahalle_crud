<?php
namespace App\Http\Controllers;
use App\Models\mahalle;
use Illuminate\Http\Request;
class mahalleController extends Controller
{
      public function index()
    {
$mahalles = mahalle::latest()->paginate(15);
return view('pages.crud-data-list-mahalle', compact('mahalles'))
      ->with('i', (request()->input('page', 1) - 1) * 15);
      }
    public function create()
    {
      $mahallex = mahalle::all();
      return view('pages.crud-form-mahalle', compact('mahallex'));
    }

    public function store(Request $request)
    {
    $request->validate(['name' => 'required']);
        mahalle::create($request->all());
        return redirect()->route('mahalle.index')
            ->with('success', 'Mahalle ekleme işlemi başarılı.');
    }

    public function show(mahalle $mahalle)
    {
      $mahalle = mahalle::find($id);
      return view('pages.crud-update-list-mahalle',compact('mahalle'));
    }
    public function edit($id)
    {
       $mahalle = mahalle::find($id);
       return view('pages.crud-form-mahalleduzenle',compact('mahalle'));

    }

    public function update(Request $request, mahalle $mahalle)
    {
      $request->validate([
          'name' => 'required',
      ]);

      $mahalle->update($request->all());

      return redirect()->route('mahalle.index')
                      ->with('success','Mahalle başarı ile güncellendi.');
    }

    public function destroy($id)
    {
        mahalle::destroy($id);
        return redirect()->route('mahalle.index')->with('success','Mahalle başarı ile silindi');
    }
}

<?php

namespace App\View\Components;

use App\Models\Contacto;
use App\Models\Idioma;
use App\Models\Logo;
use App\Models\Producto;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navbar extends Component
{
    /**
     * Create a new component instance.
     */


    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $idioma = Idioma::where('activo', 1)->first();
        $logo = Logo::all();
        $idiomas = Idioma::all();
        $currentRoute = url()->current();
        $productos = Producto::with('categorias')->get();

        if($idioma['idioma'] == 'ES'){
            $idiomaActive = 'ES';


            $opcionesNavegador = [
                ['name' => 'Nosotros', 'url' => route('nosotros')],
                ['name' => 'Productos', 'url' => route('productos')],
                ['name' => 'Aplicaciones', 'url' => route('aplicaciones')],  
                ['name' => 'Novedades', 'url' => route('novedades')], 
                ['name' => 'Solicitud de presupuesto', 'url' => route('presupuesto')],  
                ['name' => 'Contacto', 'url' => route('contacto')],
                

            ];
        }else{
       
            $idiomaActive = 'POR';


            $opcionesNavegador = [
                ['name' => 'Sobre nós', 'url' => route('nosotros')],
                ['name' => 'Produtos', 'url' => route('productos')],
                ['name' => 'Aplicações', 'url' => route('aplicaciones')],  
                ['name' => 'Novidades', 'url' => route('novedades')], 
                ['name' => 'Solicitação de orçamento', 'url' => route('presupuesto')], 
                ['name' => 'Contato', 'url' => route('contacto')],
        
            ];
        }

        foreach ($opcionesNavegador as &$option) {
            $option['active'] = ($option['url'] === $currentRoute);
        }


        return view('components.navbar', ['logo' => $logo, 'idioma' => $idioma, 'opcionesNavegador' => $opcionesNavegador, 'idiomas' => $idiomas, 'idiomaActive' => $idiomaActive, 'productos' => $productos]);
    }
}

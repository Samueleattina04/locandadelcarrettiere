<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function home()
    {
        $specialties = $this->getSpecialties();
        $testimonials = $this->getTestimonials();
        return view('pages.home', compact('specialties', 'testimonials'));
    }

    public function menu()
    {
        $menu = $this->getMenuData();
        return view('pages.menu', compact('menu'));
    }

    public function gallery()
    {
        return view('pages.gallery');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        $hours = $this->getOpeningHours();
        return view('pages.contact', compact('hours'));
    }

    private function getSpecialties(): array
    {
        return [
            [
                'icon' => 'antipasto',
                'title' => 'Antipasti Rustici',
                'description' => 'Salumi artigianali, formaggi locali e sfiziosità della tradizione siciliana preparati ogni giorno con ingredienti freschi.',
                'image' => 'antipasti',
            ],
            [
                'icon' => 'pistacchio',
                'title' => 'Cucina al Pistacchio',
                'description' => 'Il rinomato pistacchio di Bronte è il protagonista assoluto: dai primi ai secondi, fino ai dolci più raffinati.',
                'image' => 'pistacchio',
            ],
            [
                'icon' => 'grigliata',
                'title' => 'Carni Grigliate',
                'description' => 'Carni locali selezionate cotte alla griglia con le erbe aromatiche dell\'Etna, un\'esperienza di sapori autentici.',
                'image' => 'grigliata',
            ],
            [
                'icon' => 'pasta',
                'title' => 'Pasta della Tradizione',
                'description' => 'Ricette di famiglia tramandate di generazione in generazione, con pasta fatta in casa e ragù lenti.',
                'image' => 'pasta',
            ],
        ];
    }

    private function getTestimonials(): array
    {
        return [
            [
                'name' => 'Marco R.',
                'city' => 'Milano',
                'rating' => 5,
                'text' => 'Un posto magico tra l\'Etna e i Nebrodi. Gli antipasti rustici erano una scoperta, e la pasta al pistacchio di Bronte indimenticabile. Torneremo sicuramente!',
                'platform' => 'TripAdvisor',
            ],
            [
                'name' => 'Sofia L.',
                'city' => 'Roma',
                'rating' => 5,
                'text' => 'Atmosfera autentica e cibo straordinario. La carne alla griglia era cotta alla perfezione e i vini siciliani perfettamente abbinati. Consiglio vivamente!',
                'platform' => 'Google',
            ],
            [
                'name' => 'Andreas K.',
                'city' => 'München',
                'rating' => 5,
                'text' => 'Fantastic traditional Sicilian restaurant. The pistachio dishes were incredible and the staff made us feel like family. A hidden gem near Etna!',
                'platform' => 'TripAdvisor',
            ],
            [
                'name' => 'Chiara M.',
                'city' => 'Catania',
                'rating' => 5,
                'text' => 'La migliore trattoria siciliana della zona. Ingredienti freschissimi, porzioni generose e prezzi onesti. Un\'esperienza culinaria autentica da ripetere.',
                'platform' => 'Google',
            ],
        ];
    }

    private function getMenuData(): array
    {
        return [
            'antipasti' => [
                'label' => 'Antipasti',
                'icon' => '🫒',
                'description' => 'Sapori autentici per iniziare il viaggio',
                'items' => [
                    ['name' => 'Antipasto Rustico della Casa', 'desc' => 'Salumi artigianali, formaggi locali, olive condite e bruschette al pomodoro fresco', 'price' => '12.00', 'tag' => 'signature'],
                    ['name' => 'Arancini al Pistacchio di Bronte', 'desc' => 'Arancini croccanti ripieni di riso al pistacchio e provola affumicata', 'price' => '8.00', 'tag' => 'pistachio'],
                    ['name' => 'Caponata Siciliana', 'desc' => 'Melanzane, pomodori, olive, capperi e sedano in agrodolce tradizionale', 'price' => '9.00', 'tag' => null],
                    ['name' => 'Ricotta Infornata con Miele e Pistacchio', 'desc' => 'Ricotta locale cotta al forno, miele di zagara e granella di pistacchio DOP', 'price' => '10.00', 'tag' => 'pistachio'],
                    ['name' => 'Polpettine di Maiale al Sugo', 'desc' => 'Polpette di maiale nero dei Nebrodi in salsa di pomodoro San Marzano', 'price' => '11.00', 'tag' => null],
                ],
            ],
            'primi' => [
                'label' => 'Primi Piatti',
                'icon' => '🍝',
                'description' => 'La tradizione in ogni forchettata',
                'items' => [
                    ['name' => 'Pasta al Pistacchio e Salsiccia', 'desc' => 'Rigatoni con crema di pistacchio di Bronte DOP e salsiccia di maiale nero', 'price' => '14.00', 'tag' => 'pistachio'],
                    ['name' => 'Pasta alla Norma', 'desc' => 'Rigatoni con melanzane fritte, pomodoro fresco, basilico e ricotta salata', 'price' => '12.00', 'tag' => 'classic'],
                    ['name' => 'Tagliatelle al Ragù dell\'Etna', 'desc' => 'Pasta fresca fatta in casa con ragù lento di cinghiale e funghi porcini', 'price' => '16.00', 'tag' => 'signature'],
                    ['name' => 'Risotto al Pistacchio', 'desc' => 'Carnaroli mantecato con crema di pistacchio, speck e scaglie di parmigiano', 'price' => '15.00', 'tag' => 'pistachio'],
                    ['name' => 'Pasta con le Sarde', 'desc' => 'Pasta fresca con sarde, finocchietto selvatico, uvetta e pinoli tostati', 'price' => '13.00', 'tag' => 'classic'],
                    ['name' => 'Zuppa di Legumi dell\'Etna', 'desc' => 'Fagioli neri, lenticchie e ceci locali con olio extravergine e crostini', 'price' => '10.00', 'tag' => null],
                ],
            ],
            'secondi' => [
                'label' => 'Secondi Piatti',
                'icon' => '🥩',
                'description' => 'Carni e sapori dal territorio',
                'items' => [
                    ['name' => 'Grigliata Mista della Casa', 'desc' => 'Selezione di carni locali alla brace: agnello, maiale nero, salsiccia e involtini', 'price' => '22.00', 'tag' => 'signature'],
                    ['name' => 'Costolette di Agnello all\'Etna', 'desc' => 'Agnello locale marinato alle erbe dell\'Etna, grigliato e servito con patate al forno', 'price' => '20.00', 'tag' => null],
                    ['name' => 'Salsiccia di Maiale Nero dei Nebrodi', 'desc' => 'Salsiccia artigianale di suino nero con finocchietto, servita con cipolle caramellate', 'price' => '16.00', 'tag' => null],
                    ['name' => 'Filetto al Pistacchio', 'desc' => 'Filetto di manzo con crosta di pistacchio di Bronte e riduzione al vino Nero d\'Avola', 'price' => '26.00', 'tag' => 'pistachio'],
                    ['name' => 'Braciola di Maiale alla Siciliana', 'desc' => 'Braciola farcita con uova sode, salumi e formaggio, cotta nel sugo di pomodoro', 'price' => '18.00', 'tag' => 'classic'],
                ],
            ],
            'pizza' => [
                'label' => 'Pizza',
                'icon' => '🍕',
                'description' => 'Venerdì, Sabato e Domenica sera — impasto a lunga lievitazione di Fabio Gullotto',
                'note' => 'Disponibile solo Venerdì, Sabato e Domenica sera. Disponibile versione senza glutine.',
                'items' => [
                    ['name' => 'Pizza Carrettiere', 'desc' => 'Pomodoro, mozzarella fior di latte, salsiccia, pistacchio di Bronte e basilico fresco', 'price' => '13.00', 'tag' => 'signature'],
                    ['name' => 'Pizza Etna', 'desc' => 'Base bianca, mozzarella, nduja calabrese, pomodori semisecchi e rucola', 'price' => '12.00', 'tag' => null],
                    ['name' => 'Pizza Pistacchio', 'desc' => 'Crema di pistacchio DOP, mozzarella di bufala, speck e granella di pistacchio', 'price' => '14.00', 'tag' => 'pistachio'],
                    ['name' => 'Margherita della Tradizione', 'desc' => 'Pomodoro San Marzano, mozzarella fior di latte, basilico e olio extravergine', 'price' => '9.00', 'tag' => 'classic'],
                    ['name' => 'Pizza ai Funghi dell\'Etna', 'desc' => 'Base bianca, mozzarella, funghi porcini, scamorza affumicata e tartufo nero', 'price' => '15.00', 'tag' => null],
                ],
            ],
            'dolci' => [
                'label' => 'Dolci',
                'icon' => '🍮',
                'description' => 'Il finale perfetto per ogni pasto',
                'items' => [
                    ['name' => 'Cannolo Siciliano', 'desc' => 'Cialda croccante artigianale, ricotta di pecora, scaglie di cioccolato e pistacchio', 'price' => '6.00', 'tag' => 'classic'],
                    ['name' => 'Semifreddo al Pistacchio di Bronte', 'desc' => 'Cremoso semifreddo con pasta di pistacchio DOP, servito con coulis di frutti rossi', 'price' => '8.00', 'tag' => 'pistachio'],
                    ['name' => 'Cassata Siciliana', 'desc' => 'Pan di Spagna, ricotta, frutta candita e pasta reale — la regina dei dolci siciliani', 'price' => '7.00', 'tag' => 'classic'],
                    ['name' => 'Panna Cotta al Miele di Zagara', 'desc' => 'Panna cotta con miele di fiori d\'arancio siciliano e mandorle tostate', 'price' => '7.00', 'tag' => null],
                    ['name' => 'Granita con Brioche', 'desc' => 'Granita artigianale (limone, pistacchio o mandorla) con brioche col tuppo', 'price' => '5.00', 'tag' => null],
                ],
            ],
            'vini' => [
                'label' => 'Carta dei Vini',
                'icon' => '🍷',
                'description' => 'I migliori vini siciliani selezionati per voi',
                'items' => [
                    ['name' => 'Nero d\'Avola — Cantine Gulfi', 'desc' => 'Rosso corposo di Ragusa, note di ciliegia e spezie orientali — cl 75', 'price' => '22.00', 'tag' => null],
                    ['name' => 'Etna Rosso DOC — Benanti', 'desc' => 'Nerello Mascalese dai vigneti dell\'Etna, elegante e minerale — cl 75', 'price' => '28.00', 'tag' => 'signature'],
                    ['name' => 'Grillo — Donnafugata', 'desc' => 'Bianco aromatico della Sicilia occidentale, fresco con note agrumate — cl 75', 'price' => '20.00', 'tag' => null],
                    ['name' => 'Marsala Superiore DOC', 'desc' => 'Marsala ambrato secco, perfetto con i formaggi stagionati — cl 75', 'price' => '18.00', 'tag' => 'classic'],
                    ['name' => 'Vino della Casa Rosso / Bianco', 'desc' => 'Selezione locale in caraffa — cl 25 / cl 50 / cl 75', 'price' => '4.00', 'tag' => null],
                ],
            ],
        ];
    }

    private function getOpeningHours(): array
    {
        return [
            ['day' => 'Lunedì', 'lunch' => '11:30 – 14:30', 'dinner' => '19:30 – 22:00', 'closed' => false],
            ['day' => 'Martedì', 'lunch' => null, 'dinner' => null, 'closed' => true],
            ['day' => 'Mercoledì', 'lunch' => '11:30 – 14:30', 'dinner' => '19:30 – 22:00', 'closed' => false],
            ['day' => 'Giovedì', 'lunch' => '11:30 – 14:30', 'dinner' => '19:30 – 22:00', 'closed' => false],
            ['day' => 'Venerdì', 'lunch' => '11:30 – 14:30', 'dinner' => '19:30 – 23:30', 'closed' => false],
            ['day' => 'Sabato', 'lunch' => '11:30 – 14:30', 'dinner' => '19:30 – 23:45', 'closed' => false],
            ['day' => 'Domenica', 'lunch' => '11:30 – 14:30', 'dinner' => '19:30 – 23:30', 'closed' => false],
        ];
    }
}

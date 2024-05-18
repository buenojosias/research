<?php

namespace App\Livewire\Production;

use App\Models\Project;
use App\Models\State;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ProductionCreate extends Component
{
    public $project;
    public $bibliometric;
    public $repositories;
    public $years = [];
    public $states = [];

    public $author = [];
    public $authors_display = [];

    #[Validate('nullable|url')]
    public $url;

    #[Validate('nullable|string|in_array:bibliometric.repositories.*')]
    public $repository;

    #[Validate('required|string')]
    public $title;

    #[Validate('nullable|string')]
    public $subtitle;

    #[Validate('required|integer|digits:4|in_array:years.*')]
    public $year;

    #[Validate('required|array')]
    public $authors = [];

    #[Validate('required|string|in_array:bibliometric.types.*')]
    public $type;

    #[Validate('required|string|in_array:bibliometric.languages.*')]
    public $language;

    #[Validate('required|array')]
    public $searched_terms;

    #[Validate('nullable|string')]
    public $institution;

    #[Validate('nullable|string')]
    public $program;

    #[Validate('nullable|string')]
    public $city;

    #[Validate('nullable|integer|in_array:states.*.id')]
    public $state_id;

    #[Validate('nullable|string')]
    public $periodical;

    #[Validate('nullable|string')]
    public $doi;

    public $keywords;

    public $abstract;
    public $abstract_preview;

    public function mount(Project $project)
    {
        $this->project = $project;

        $this->bibliometric = $project->bibliometric;

        for($i = intval($this->bibliometric->start_year); $i <= $this->bibliometric->end_year; $i++) {
            array_push($this->years, $i);
        }

        $this->states = State::select('id', 'abbreviation')->orderBy('abbreviation')->get()->toArray();
    }

    public function save()
    {
        $data = $this->validate();
        $keywords = $this->serializeKeywords();

        \DB::beginTransaction();
        $createdProduction = $this->project->productions()->create($data);
        $createdKeywords = $createdProduction->keywords()->create(['data' => $keywords]);
        if($abstractData = $this->serializeAbstract())
            $createdProduction->abstract()->create($abstractData);

        if($createdProduction && $createdKeywords) {
            \DB::commit();
            session()->flash('status', 'Produção adicionada com sucesso.');
            $this->redirectRoute('project.bibliometrics.productions.show', [$this->project, $createdProduction], navigate: true);
        } else {
            \DB::rollBack();
            dump('deu ruim');
        }
    }

    public function serializeKeywords()
    {
        $keywords = str_replace(['.',';'], ',', $this->keywords);
        $keywords = array_filter(explode(',', $keywords));
        $keywords = array_map('trim', $keywords);
        $keywords = array_map('strtolower', $keywords);
        return $keywords;
    }

    public function serializeAbstract()
    {
        $abstract = $this->abstract ?? null;
        if (!$abstract)
            return null;

        $data = [];
        $data['section'] = 'resumo';
        $data['content'] = $this->abstract ?? null;
        $diacritics = 'aàȁáâǎãāăȃȧäåẚảạḁąᶏậặầằắấǻẫẵǡǟẩẳⱥæǽǣᴂꬱꜳꜵꜷꜹꜻꜽɐɑꭤᶐꬰɒͣᵃªᵄᵆᵅᶛᴬᴭᴀᴁₐbḃƅƀᵬɓƃḅḇᶀꞗȸßẞꞵꞛꞝᵇᵝᴮᴯʙᴃᵦcćĉčċƈçḉɕꞔꞓȼ¢ʗᴐᴒɔꜿᶗꝢꝣ©ͨᶜᶝᵓᴄdďḋᵭðđɗᶑḓḍḏḑᶁɖȡꝱǳʣǆʤʥȸǲǅꝺẟƍƌͩᵈᶞᵟᴰᴅᴆeèȅéēêěȇĕẽėëẻḙḛẹȩęᶒⱸệḝềḕếḗễểɇəǝɘɚᶕꬲꬳꬴᴔꭁꭂ•ꜫɛᶓȝꜣꝫɜᴈᶔɝɞƩͤᵉᵊᵋᵌᶟᴱᴲᴇⱻₑₔfẜẝƒꬵḟẛᶂᵮꞙꝭꝼʩꟻﬀﬁﬂﬃﬄᶠꜰgǵḡĝǧğġģǥꬶᵷɡᶃɠꞡᵍᶢᴳɢʛhħĥȟḣḧɦɧḫḥẖḩⱨꜧꞕƕɥʮʯͪʰʱꭜᶣᵸꟸᴴʜₕiìȉíīĩîǐȋĭïỉɨḭịįᶖḯıɩɪꭠꭡᴉᵻᵼĳỻİꟾꟷͥⁱᶤᶦᵎᶧᶥᴵᵢjȷĵǰɉɟʝĳʲᶡᶨᴶᴊⱼkḱǩꝁꝃꝅƙḳḵⱪķᶄꞣʞĸᵏᴷᴋₖlĺľŀłꝉƚⱡɫꬷꬸɬꬹḽḷḻļɭȴᶅꝲḹꞎꝇꞁỻǈǉʪʫɮˡᶩᶪꭝꭞᶫᴸʟᴌₗmḿṁᵯṃɱᶆꝳꬺꭑᴟɯɰꟺꟿꟽͫᵐᶬᶭᴹᴍₘnǹńñňŉṅᵰṇṉṋņŋɳɲƞꬻꬼȵᶇꝴꞃꞑꞥᴝᴞǋǌⁿᵑᶯᶮᶰᴺᴻɴᴎₙoᴏᴑòȍóǿőōõôȏǒŏȯöỏơꝍọǫⱺꝋɵøᴓǭộợồṑờốṍṓớỗỡṏȭȱȫổởœɶƣɸƍꝏʘꬽꬾꬿꭀꭁꭂꭃꭄꭢꭣ∅ͦᵒᶱºꟹᶲᴼᴽₒpṕṗꝕꝓᵽᵱᶈꝑþꝥꝧƥƪƿȹꟼᵖᴾᴘᴩᵨₚqʠɋꝙꝗȹꞯʘθᶿrŕȑřȓṙɍᵲꝵꞧṛŗṟᶉꞅɼɽṝɾᵳᴦɿſⱹɹɺɻ®ꝶꭇꭈꭉꭊꭋꭌͬʳʶʴʵᴿʀʁᴙᴚꭆᵣsśŝšṡᵴꞩṣşșȿʂᶊṩṥṧƨʃʄʆᶋᶘꭍʅƪﬅﬆˢᶳᶴꜱₛtťṫẗƭⱦᵵŧꝷṱṯṭţƫʈțȶʇꞇꜩʦʧʨᵺͭᵗᶵᵀᴛₜuùȕúűūũûǔȗŭüůủưꭒʉꞹṷṵụṳųᶙɥựǜừṹǘứǚữṻǖửʊᵫᵿꭎꭏꭐꭑͧᵘᶶᶷᵙᶸꭟᵁᴜᵾᵤvṽⱱⱴꝟṿᶌʋʌͮᵛⱽᶹᶺᴠᵥwẁẃŵẇẅẘⱳẉꝡɯɰꟽꟿʍʬꞶꞷʷᵚᶭᵂᴡxẋẍᶍ×ꭓꭔꭕꭖꭗꭘꭙˣ˟ᵡₓᵪyỳýȳỹŷẏÿẙỷƴɏꭚỵỿɣɤꝩʎƛ¥ʸˠᵞʏᵧzźẑžżƶᵶẓẕʐᶎʑȥⱬɀʒǯʓƺᶚƹꝣᵹᶻᶼᶽᶾᴢᴣ';
        $data['total_words'] = str_word_count($abstract, 0, $diacritics);

        return $data;
    }

    public function render()
    {
        return view('livewire.production.production-create')
            ->title('Adicionar produção');
    }

    public function addAuthor()
    {
        $this->validate([
            'author.forename' => 'required|string',
            'author.lastname' => 'required|string',
        ]);
        array_push($this->authors, [ 'forename' => $this->author['forename'], 'lastname' => $this->author['lastname'] ]);
        array_push($this->authors_display, ' ' . $this->author['forename'] .' '. $this->author['lastname']);
        $this->reset('author');
    }

    public function removeAuthor($key)
    {
        array_splice($this->authors, $key, 1);
        array_splice($this->authors_display, $key, 1);
    }

}

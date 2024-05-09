<?php

namespace App\Livewire\Production;

use App\Models\Research;
use App\Models\State;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ProductionCreate extends Component
{
    public $research;
    public $repositories;
    public $years = [];
    public $states = [];

    #[Validate('required|url')]
    public $url;

    #[Validate('required|string|in_array:research.repositories.*')]
    public $repository;

    #[Validate('required|string')]
    public $title;

    #[Validate('nullable|string')]
    public $subtitle;

    #[Validate('required|integer|digits:4|in_array:years.*')]
    public $year;

    #[Validate('required|string')]
    public $author_forename;

    #[Validate('required|string')]
    public $author_lastname;

    #[Validate('required|string|in_array:research.types.*')]
    public $type;

    #[Validate('required|string|in_array:research.languages.*')]
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

    public function mount(Research $research)
    {
        // $this->research = $research;

        for($i = $this->research->start_year; $i <= $this->research->end_year; $i++) {
            array_push($this->years, $i);
        }

        $this->states = State::select('id', 'abbreviation')->orderBy('abbreviation')->get()->toArray();
    }

    public function save()
    {
        $data = $this->validate();
        $keywords = $this->serializeKeywords();
        // $abstract = $this->abstract ?? null;

        \DB::beginTransaction();
        $createdPublication = $this->research->publications()->create($data);
        $createdKeywords = $createdPublication->keywords()->create(['data' => $keywords]);
        if($abstractData = $this->serializeAbstract())
            $createdAbstract = $createdPublication->abstract()->create($abstractData);

        if($createdPublication && $createdKeywords) {
            \DB::commit();
            session()->flash('status', 'Publicação salva com sucesso.');
            $this->redirectRoute('researches.publications.show', [$this->research, $createdPublication], navigate: true);
        } else {
            \DB::rollBack();
            dump('deu ruim');
        }
    }

    public function serializeKeywords()
    {
        $keywords = str_replace(['.',';'], ',', $this->keywords);
        $keywords = explode(',', $keywords);
        return $keywords;
    }

    public function serializeAbstract()
    {
        $abstract = $this->abstract ?? null;
        if (!$abstract)
            return null;

        $data = [];
        $data['section'] = 'abstract';
        $data['content'] = $this->abstract ?? null;
        $diacritics = 'aàȁáâǎãāăȃȧäåẚảạḁąᶏậặầằắấǻẫẵǡǟẩẳⱥæǽǣᴂꬱꜳꜵꜷꜹꜻꜽɐɑꭤᶐꬰɒͣᵃªᵄᵆᵅᶛᴬᴭᴀᴁₐbḃƅƀᵬɓƃḅḇᶀꞗȸßẞꞵꞛꞝᵇᵝᴮᴯʙᴃᵦcćĉčċƈçḉɕꞔꞓȼ¢ʗᴐᴒɔꜿᶗꝢꝣ©ͨᶜᶝᵓᴄdďḋᵭðđɗᶑḓḍḏḑᶁɖȡꝱǳʣǆʤʥȸǲǅꝺẟƍƌͩᵈᶞᵟᴰᴅᴆeèȅéēêěȇĕẽėëẻḙḛẹȩęᶒⱸệḝềḕếḗễểɇəǝɘɚᶕꬲꬳꬴᴔꭁꭂ•ꜫɛᶓȝꜣꝫɜᴈᶔɝɞƩͤᵉᵊᵋᵌᶟᴱᴲᴇⱻₑₔfẜẝƒꬵḟẛᶂᵮꞙꝭꝼʩꟻﬀﬁﬂﬃﬄᶠꜰgǵḡĝǧğġģǥꬶᵷɡᶃɠꞡᵍᶢᴳɢʛhħĥȟḣḧɦɧḫḥẖḩⱨꜧꞕƕɥʮʯͪʰʱꭜᶣᵸꟸᴴʜₕiìȉíīĩîǐȋĭïỉɨḭịįᶖḯıɩɪꭠꭡᴉᵻᵼĳỻİꟾꟷͥⁱᶤᶦᵎᶧᶥᴵᵢjȷĵǰɉɟʝĳʲᶡᶨᴶᴊⱼkḱǩꝁꝃꝅƙḳḵⱪķᶄꞣʞĸᵏᴷᴋₖlĺľŀłꝉƚⱡɫꬷꬸɬꬹḽḷḻļɭȴᶅꝲḹꞎꝇꞁỻǈǉʪʫɮˡᶩᶪꭝꭞᶫᴸʟᴌₗmḿṁᵯṃɱᶆꝳꬺꭑᴟɯɰꟺꟿꟽͫᵐᶬᶭᴹᴍₘnǹńñňŉṅᵰṇṉṋņŋɳɲƞꬻꬼȵᶇꝴꞃꞑꞥᴝᴞǋǌⁿᵑᶯᶮᶰᴺᴻɴᴎₙoᴏᴑòȍóǿőōõôȏǒŏȯöỏơꝍọǫⱺꝋɵøᴓǭộợồṑờốṍṓớỗỡṏȭȱȫổởœɶƣɸƍꝏʘꬽꬾꬿꭀꭁꭂꭃꭄꭢꭣ∅ͦᵒᶱºꟹᶲᴼᴽₒpṕṗꝕꝓᵽᵱᶈꝑþꝥꝧƥƪƿȹꟼᵖᴾᴘᴩᵨₚqʠɋꝙꝗȹꞯʘθᶿrŕȑřȓṙɍᵲꝵꞧṛŗṟᶉꞅɼɽṝɾᵳᴦɿſⱹɹɺɻ®ꝶꭇꭈꭉꭊꭋꭌͬʳʶʴʵᴿʀʁᴙᴚꭆᵣsśŝšṡᵴꞩṣşșȿʂᶊṩṥṧƨʃʄʆᶋᶘꭍʅƪﬅﬆˢᶳᶴꜱₛtťṫẗƭⱦᵵŧꝷṱṯṭţƫʈțȶʇꞇꜩʦʧʨᵺͭᵗᶵᵀᴛₜuùȕúűūũûǔȗŭüůủưꭒʉꞹṷṵụṳųᶙɥựǜừṹǘứǚữṻǖửʊᵫᵿꭎꭏꭐꭑͧᵘᶶᶷᵙᶸꭟᵁᴜᵾᵤvṽⱱⱴꝟṿᶌʋʌͮᵛⱽᶹᶺᴠᵥwẁẃŵẇẅẘⱳẉꝡɯɰꟽꟿʍʬꞶꞷʷᵚᶭᵂᴡxẋẍᶍ×ꭓꭔꭕꭖꭗꭘꭙˣ˟ᵡₓᵪyỳýȳỹŷẏÿẙỷƴɏꭚỵỿɣɤꝩʎƛ¥ʸˠᵞʏᵧzźẑžżƶᵶẓẕʐᶎʑȥⱬɀʒǯʓƺᶚƹꝣᵹᶻᶼᶽᶾᴢᴣ';
        $data['total_words'] = str_word_count($abstract, 0, $diacritics);

        return $data;
    }

    public function render()
    {
        return view('livewire.production.production-create')
            ->title('Nova publicação');
    }
}

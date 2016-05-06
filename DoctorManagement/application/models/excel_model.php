<?php
	class Excel_model extends CI_Model {
		public function __construct() {       
			parent:: __construct();

			// Load the database
			$this->load->database();

			// Load the session library
			$this->load->library('session');

			// Load the database model
			$this->load->model('database_model', 'database');
		}

		public function CreateProcedures() {
			$str = "";
			$exp = explode("\n", $str);

			for($i=0;$i<count($exp);$i++) {
				$tab = explode("\t", $exp[$i]);
				echo $tab[0].' '.$tab[2].'<br>';
				$procedure = $tab[0];
				$price = $tab[2];

				$this->db->select('*');
				$this->db->where('name', $procedure);
				$query = $this->db->get('procedures');
				$count = $query->num_rows();

				if($count == 1) {
					$data = array('national_avg' => $price);
					$this->db->where('name', $procedure);
					$this->db->update('procedures', $data);
				}
			}
		}

		public function Insert() {
			$str = "";			
			$exp = explode("\n", $str);

			for($i=0;$i<count($exp);$i++) {
				$tab = explode("\t", $exp[$i]);
				FormatArray($tab);

				if(count($tab) == 6) {
					$id = $tab[0];
					$address = $tab[1];
					$city = $tab[2];
					$state = $tab[3];
					$zip = $tab[4];
					$phone = $tab[5];

					$info = array('address' => $address,
								'city' => $city,
								'state' => $state,
								'zip_code' => $zip,
								'phone' => $phone);
					$this->db->where('id', $id);
					$this->db->update('doctors', $info);
				} 

				echo '<br><br>';
			}
		}

		public function Location() {
			$this->db->select('*');
			$this->db->where(array('id >' =>  399, 'id <' => 490));
			$query = $this->db->get('doctors');
			$count = $query->num_rows();
			$i = 0;
			$return = [];

			foreach($query->result() as $row) {
				$id[$i] = $row->id;
				$address[$i] = $row->address;
				$city[$i] = $row->city;
				$state[$i] = $row->state;

				$i++;
			}

			for($i=0;$i<$count;$i++) {
				$loc = $this->loc->MapquestLocation($address[$i].', '.$city[$i], $state[$i]);
				FormatArray($loc);

				$data = array('lon' => $loc['lng'], 'lat' => $loc['lat']);
				$this->db->where('id', $id[$i]);
				$this->db->update('doctors', $data);
			}
		}

		public function Specs() {
			$str = "";
			$doctor_id = 492;
			$exp = explode("\n", $str);

			for($i=0;$i<count($exp);$i++) {
				$trim = trim($exp[$i]);

				$this->db->select('*');
				$this->db->where('name', $trim);
				$query = $this->db->get('procedures');
				$num = $query->num_rows();

				if($num == 1) {
					$row = $query->result();
					$procedure_id = $row[0]->id;
				} else {
					$data = array('name' => $trim, 'type' => 'Orthopedic');
					$this->db->insert('procedures', $data);

					$this->db->select('*');
					$this->db->where('name', $trim);
					$query = $this->db->get('procedures');
					$row = $query->result();
					$procedure_id = $row[0]->id;
				}

				$this->db->select('*');
				$this->db->where(array('real_id' => $procedure_id, 'doctor_id' => $doctor_id));
				$query = $this->db->get('new_specialties');
				$count = $query->num_rows();

				if($count == 0) {
					$info = array('doctor_id' => $doctor_id,
								'name' => $trim,
								'name_id' => $procedure_id,
								'procedure_name' => $trim,
								'real_id' => $procedure_id,
								'is_match' => 2);
					$this->db->insert('new_specialties', $info);
				}
			}
		}

		public function InsertMasonry() {
			$str = "Photo 1: Dr. Haideh Hirmand was photographed at the Bridgehampton Polo Club Opening Day.
Photo 2: Dr. Haideh Hirmand was featured in More Magazine.";
			$exp = explode("\n", $str);

			for($i=1;$i<18;$i++) {
				if($i < 16) {
					$new = explode(": ", $exp[$i]);
					FormatArray($new);
					$title = $new[1];
					// $caption = $new[1];
				} else {
					$title = '';
					// $caption = '';
				}

				if($i < 16) {
					$img = $i;
				} else {
					if($i == 16) {
						$img = 'Haideh Hirmand, M.D., F.A.C.S.';
					} else {
						$img = 'Haideh Hirmand, M.D., F.A.C.S';
					}
				}

				$data = array('doctor_id' => 125,
							'img' => $img.'.jpg',
							'title' => $title,
							'description' => '');
				FormatArray($data);
				$this->db->insert('masonry', $data);
			}
		}

		public function InsertSpecialties() {
			$str = "Breast Implants, Liposuction, Tummy Tuck, Blepharoplasty (Eyes), BOTOX, Browlift, Buccal Fat Removal, Cheek Augmentation, Chin Augmentation, Chemical Peels, Dermabrasion, Microdermabrasion, Ear Pinning (Otoplasty), Facelift, Fat Grafting, Juvederm, Laser Hair Removal, Laser Genesis (Skin Rejuvenation), Rhinoplasty, Spider Vein Treatment (Sclerotherapy)";
			$exp = explode(",", $str);
			FormatArray($exp);

			for($i=0;$i<count($exp);$i++) {
				$sql = "SELECT id FROM procedures
						WHERE name = ?";
				$query = $this->db->query($sql, array(trim($exp[$i])));
				$count = $query->num_rows(); 

				if($count == 1) {
					$result = $query->result();
					$id = $result[0]->id;

					$sql = "SELECT id FROM new_specialties
							WHERE real_id = ? AND doctor_id = ?";
					$query = $this->db->query($sql, array($id, 495));
					$num = $query->num_rows();
					echo $num.'<br>';

					if($num == 0) {
						$data = array('doctor_id' => 495,
									'name' => trim($exp[$i]),
									'name_id' => $id,
									'procedure_name' => trim($exp[$i]),
									'real_id' => $id,
									'is_match' => 2);
						$this->db->insert('new_specialties', $data);
					}
				} else {
					$data = array('name' => trim($exp[$i]));
					$this->db->insert('procedures', $data);

					$sql = "SELECT id FROM procedures
							WHERE name = ?";
					$query = $this->db->query($sql, array(trim($exp[$i])));
					$result = $query->result();
					$id = $result[0]->id;

					$data = array('doctor_id' => 495,
								'name' => trim($exp[$i]),
								'name_id' => $id,
								'procedure_name' => trim($exp[$i]),
								'real_id' => $id,
								'is_match' => 2);
					$this->db->insert('new_specialties', $data);
				}
			}
		} 

		public function InsertKeywords() {
			$str = '24 hair transplant
300cc
6 month smiles
aamod rao
abdominoplasty
abdominoplasty before and after
abdominoplasty westchester
accutane
accutane before and after
accutane blackheads
accutane cost
accutane reviews
acne before and after
acne laser treatment
acne scar laser treatment
acne scar removal
acne treatment
acne treatment houston
acutane
advanced dermatology reviews
affirm laser
alarplasty
alexia pills
alfredo hoyos
alignment pins
all on 4 dental implants cost
allen rhinoplasty
anil shah
arbonne products
arbonne reviews
areola reduction
areola size
areolas
arm lift
artefill
ask a doctor
ask a doctor free
ask a doctor online
ask doctor
ask doctor online
ask doctors
ask the doctor
ass implant
ass implants
ass shot
ass shots
at home chemical peel
athenix
atrophic scars
augmentation
augmentation rhinoplasty mount kisco
average cost of invisalign
bags under eyes
banh xeo
before after
before after teeth whitening
before and after photos
belotero
best chemical peel houston
best derma roller
best hair transplant
best hair transplant in hyderabad
best laser hair removal
best laser hair removal machine
best nose jobs
beverly hills md dark spot corrector
big teeth
birthday bash
birthmark removal
blepharoplasty
blepharoplasty cost
body jet liposuction
body lift
body sculpting
body wrap
body wraps
botex
botox alternative
botox and fillers
botox before after
botox before and after
botox cosmetic
botox cost
botox doctor in miami
botox eyebrow lift
botox for migraines
botox forehead
botox images
botox injection price
botox lips
botox miami
botox prices
botox under eyes
botox vs dysport
bottom teeth smile
braces before and after
brachioplasty
brad pitt acne
brazilian
brazilian laser hair removal
brest implant healing time
bright smile
brite smile
britesmile
broken capillaries
brow lift
brow lift before and after
brown spots
brown spots on face
buccal fat
buccal fat removal
buck teeth
bulbous nose
bump on nose
bumps under eyes
bus accident injury attorney bridgeport
c cup
calf augmentation
calf implant
calf implants
can i
candela gentlelase
candela laser
capsular contracture
carboxy therapy
carboxytherapy
careprost
causes of infertility in women
cavi lipo
cavitation treatment
cellulaze
cellulite removal
cellulite statistics
cellulite treatment
cellulite treatment reviews
cerec crown
cerec crowns
cheek augmentation
cheek filler
cheek implants
cheek lift
cheek tx to houston tx
cheekbone implants
chemical peel
chemical peel before and after
chemical peel cost
chemical peeling
chemical peels
chemosis
chin augmentation
chin fillers
chin implant
chin implant men
chin implants
chin implants before and after
chin lift
chin liposuction
chin reduction
chin tuck
chipped tooth
clear choice
clear choice cost
clear choice dental
clear choice dental implants cost
clear choice reviews
clear correct
clearchoice
clearcorrect
closed comedones
closed rhinoplasty
co2
co2 fractional laser
co2 laser
cocaine nose
cold sculpting
collagen injections
composite veneers
compression garment
construction site accidents attorney white plains
cool lipo
cool sculpting
coolsculpting
coolsculpting before and after
coolsculpting cost
coolsculpting machine
coolsculpting nyc
coolsculpting reviews
coolsculpting risks
cosmedica hair transplant
cosmelan
cosmetic acupuncture
cosmetic dentistry
cosmetic dentistry cost
cosmetic houston
cost of botox
cost of coolsculpting
cost of dental implants
cost of hair transplant
cost of hair transplantation
cost of implants
cost of invisalign
cost of labiaplasty
cost of laser hair removal
cost of liposuction
cost of mole removal
cost of rhinoplasty
cost of teeth whitening
cost of veneers
costco
criminal attorney jersey city
crooked nose
crows feet
cryolipolysis
cupids bow
d cup
dallas rhinoplasty
damon braces
dark circles
dark circles treatment
dead scar leveling
dead tooth
deformity
dennie morgan lines
dental bonding
dental bonding cost
dental crown cost
dental implant after extraction
dental implant cost
dental implant costs
dental implant images
dental implants
dental implants cost
dental implants images
dental implants india
dental implants prices
dental veneers
dental veneers cost
derma roller
derma roller before and after
derma roller for face
derma roller review
derma roller reviews
derma rollers
derma rolling
derma wand
derma wand review
derma wand reviews
dermal filler
dermal fillers
dermapen
dermaplaning
dermaroller
dermaroller before and after
dermaroller results
dermaroller stretch marks
dermaroller treatment
dermarolling
dermawand
desert
design veronique
desilva
deviated septum
do body wraps work
do you buzz
does coolsculpting work
does invisalign work
does laser hair removal work
does laser lipo work
does medicaid cover dental
does minoxidil work
does proactive work
does ultrasonic cavitation work
double eyelid
dr farella
dr ghavami
dr glitter
dr john farella
dr randal haworth reviews
dr revis
dr rohrich reviews
dr. cho
dr. louis dejoseph yelp
dr. michael salzhauer
dr. paul vitenas
drlima
dysport
dysport injections
dysport vs botox
e matrix
e-matrix
ear lobe
eating well
ecommerce consulting westchester
edgar contreras
electrolysis hair removal
elure
ematrix
emax veneers
endermologie
endoscopic brow lift
endoscopic brow lift cost houston texas
epidermal-leveling
erbium laser
ethnic rhinoplasty
exilis
exilis treatment
eye bag removal
eye bags removal
eye bags treatment
eye lift
eyebrow lift
eyebrow tattoo
face lift
face lift before and after
face lifting
face liposuction
facelift
facelift bellevue
facelift cost
facelift westchester
facs doctor
fastbraces reviews
fat bags under eyes
fat freezing
fat grafting
fat injection
fat injections
fat mons pubis
fat nose
fat removal
fat transfer
filler
filler for cheeks
fillers
filling the ranks
fine line treatment
fine lines under eyes
flat nose
forehead reduction
forehead wrinkles
fractional co2 laser
fractional laser
fractional laser treatment
frank ferraro
fraxel
fraxel laser
fraxel laser cost
fraxel repair
freeze the fat
front tooth crown
fue
fue hair
fue hair transplant
fue hair transplant cost
fue hair transplantation
full c
galvanic spa
gap between teeth
gastric bypass
gastric sleeve before and after
gastric sleeve diet
gastric sleeve forum
generic latisse
genioplasty
glabella
glabellar lines
glutathione injections before and after
glycolic acid
glycolic acid peel
glycolic acid peel before and after
glycolic peel
goddess post
green peel
gum contouring
gummy bear implants
gummy smile
gynecomastia
gynecomastia exercise
hair doctor
hair graft
hair grafting
hair implant
hair implants
hair laser removal
hair on film
hair plantation
hair plugs
hair plugs before and after
hair plugs cost
hair removal laser
hair removal reviews
hair replacement
hair replacement cost
hair restoration
hair restoration cost
hair transplant
hair transplant before and after
hair transplant cost
hair transplant in hyderabad
hair transplant in turkey
hair transplant istanbul
hair transplant price
hair transplant procedure
hair transplant reviews
hair transplant turkey
hair transplantation
hair transplantation cost
hair transplantation in turkey
hair transplantation turkey
hair transplants
hate my life
hemosiderin
hemosiderin staining
hollow eyes
hook nose before and after
how does botox work
how lon
how long do crowns last
how long does botox last
how much are dental implants
how much are veneers
how much do dental implants cost
how much do tattoos cost
how much do veneers cost
how much does a crown cost
how much does a nickel weigh
how much does a nose job cost
how much does a tummy tuck cost
how much does botox cost
how much does coolsculpting cost
how much does invisalign cost
how much does invisalign cost without insurance
how much does laser hair removal cost
how much does liposuction cost
how much does tattoo removal cost
how much does teeth whitening cost
how much is a nose job
how much is a nose job?
how much is a tummy tuck
how much is botox
how much is coolsculpting
how much is invisalign
how much is laser hair removal
how much is liposuction
how to become white
how to get abs
how to get chubby cheeks
how to get rid of eye bags
how to get rid of milia
how to promote your youtube channel
how to remove acne scars
how to remove milia
how to remove scars
hyaluronidase
hydrogel injections
hydrogen peroxide teeth
hydrogen peroxide teeth whitening
hydroquinone cream
hyperpigmentation
hyperpigmentation treatment
hypertrophic scar
hypertrophic scars
hypopigmentation
i lipo
i lipo reviews
i-lipo
ice pick scars
ideal image
ilipo
imagefap
incognito braces
incognito braces cost
injectable fillers
injectables
intense pulsed light
invisalign
invisalign attachments
invisalign before after
invisalign before and after
invisalign braces
invisalign cost
invisalign discount
invisalign retainer
invisalign reviews
invisalign vs braces
invisaline
invisible fence
invisilign
invisiline
ipl
ipl hair removal
ipl laser
ipl results
ipl treatment
ipl treatments
is invisalign worth it
is laser hair removal permanent
isolaz
isotretinoin cost
it works
it works body wrap reviews
it works body wraps
it works body wraps reviews
it works products
it works review
it works reviews
it works scam
it works thermofit reviews
it works wrap
it works wraps
it works wraps review
it works wraps reviews
it works!
itworks
itworks scam
itworks store
itworks wraps
itworks wraps reviews
jaw implant
jaw line
jenu
jessner peel
jowels
jowl bacon
jowls
juvaderm
juvederm
juvederm before and after
juvederm cost
juvederm for lips
juvederm lip filler
juvederm reviews
juvederm ultra
juvederm voluma
juvederm voluma cost
kemp dental
kitchen tiles hartsdale
kor whitening
labia
labia minora
labiaplasty
labiaplasty before after
labiaplasty before and after
labiaplasty cost
labiaplasty san diego
labioplasty
lap band
lap band cost
large areola
laser acne scar removal
laser acne treatment
laser epilation
laser face lift
laser fat removal
laser genesis
laser hair removal
laser hair removal before and after
laser hair removal cost
laser hair removal machines
laser hair removal omaha
laser hair removal reviews
laser hair removal side effects
laser hair removal treatment
laser icon
laser lipo
laser lipo does it work
laser lipo reviews
laser lipolysis
laser liposuction
laser mini face lift
laser mole removal
laser mole removal aftercare
laser mole removal cost
laser peel
laser resurfacing
laser resurfacing cost
laser scar removal
laser stretch mark removal
laser tattoo removal
laser tattoo removal cost
laser treatment for acne
laser treatment for acne scars
laser treatment for hair removal
laser treatment for stretch marks
latisse
latisse before and after
latisse cost
latisse coupon
latisse hair loss
latisse price
led light therapy
led therapy
libiaplasty
lifestyle lift
lift images
lightsheer
lines under eyes
lingual braces
lingual orthodontics
lip augmentation
lip augmentation before and after
lip enhancement
lip filler
lip fillers
lip injections
lip injections before and after
lip injections cost
lip job
lip lift
lip lines
lip reduction
lipo
lipo cavitation
lipo cavitation before and after
lipo laser
lipocavitation
lipodissolve
lipodissolve in 2015 web md
lipolaser
lipoma
lipoma removal
liposculpture
liposonix
liposuction
liposuction before after
liposuction before and after
liposuction cost
liposuction side effects
liposuction westchester
liposuction westchester ny
liquid facelift
long face syndrome
lower blepharoplasty
lower body lift
lpg endermologie
lumineers
lumineers cost
lumineers dental
lumineers teeth
lumineers vs veneers
lypo spheric vitamin c
malar bags
marionette lines
mastopexy cost
mastopexy westchester
md facs
meger
melanin injections
melanotan
melanotan 2
melarase
melarase cream
mesotherapy
mesotherapy before and after
mesotherapy face
michael salzhauer
micro needling
micro needling before and after
microderma
microneedling
milia removal
milia under eye
milia under eyes
mini abdominoplasty
mini dental implants
mini face lift
mini facelift
mini implants
mini lift
mini tummy tuck
minilift
minoxidil beard
minoxidil results
miradry
miss caroline mills
mole excision
mole removal
mole removal cost
mole removal laser
mommy makeover
mommy makeover cost
mons pubis
monsplasty
most popular cosmetic procedures for women
my it works
my springfield mommy
nadia afridi
nasolabial
nasolabial fold
nasolabial folds
nasolabial wrinkles
natural pain relief new city ny
neck lift
neograft
nivea creme
non invasive lipo houston
non surgical face lift
non surgical facelift
non surgical facelift options
non surgical liposuction
non surgical nose job
non surgical tummy tuck
nose bridge
nose cartilage
nose cast
nose job
nose job before and after
nose job cost
nose job recovery time
nose job toronto
nose jobs
nose jobs before and after
nose secret
nose straightener
nose up
nose up clipper
nosejob
omaha botox
omaha laser hair removal
omaha tattoo removal
one eye smaller than the other
otoplasty
otoplasty cost
otoplasty recovery
panniculectomy
parole attorney ny
paul fine texas medical board
paul tulley
pelleve
perlane
perlane filler
permalip
permanent eyebrows
permanent eyeliner
permanent hair removal
permanent laser hair removal
permanent makeup
permanent makeup eyebrows
personal training in home rye brook ny
phenol peel
photodynamic therapy
phyto lift
picosure
piona strong bleaching cream
plano rhinoplasty
plumbing repair services westchester
pmma injections
pock marks
pockmarks
poikiloderma of civatte
pointed nose
porcelain veneers
porcelain veneers cost
power swabs reviews
pregnancy mask
prk recovery
prk recovery timeline
professional teeth whitening
protinex side effects
protruding teeth
pt-137
pt137
pulsed dye laser
punch excision
radiesse
radiesse cost
radiesse vs juvederm
raelynn
rajee narinesingh
re-grouting tile westchester
real self
real self jaw botox
realself
realself .com fractional laser
realself logo
realself.com
receding chin
redweek
remove eye bags
restylane
restylane before and after
restylane cost
restylane silk
restylane westchester
retainer
retin a
retin a before and after
retin a cream
retin a gel
retin a reviews
retin-a
retin-a before after
retin-a cream
revision rhinoplasty
revitalash
rhinoplasty
rhinoplasty before and after
rhinoplasty cost
rhinoplasty dallas
rhinoplasty doctor toronto
rhinoplasty doctors toronto
rhinoplasty in texas
rhinoplasty plano
rhinoplasty recovery
rhinoplasty recovery time
rhinoplasty seattle
rhinoplasty texas
rhinoplasty toronto
rhinosplasty
rihanna nose job
robbery attorney jersey city
rolling scars
roloxin lift
safe deck construction services spring valley ny
salicylic acid peel
saline vs silicone implants
scar removal
scar removal before and after
scar removal cream
scar removal treatment
scar revision cost
scar treatment
sciton laser
sclerotherapy
sculptra
sebaceous hyperplasia
self.com
selphyl
semi permanent makeup
septoplasty
septoplasty cost
septoplasty recovery
seroma
sheyla hershey
side profile
silhouette face
silhouette lift
silicon image
silicone allergy
silicone implants
silicone injections
silikon
six month smile
six month smiles
sleeve gastrectomy
sliding genioplasty
slim freezer
slim lipo
smaili
small nose
small teeth
smart lipo
smartlipo
smartlipo reviews
smas
smile brite
smile care club
smile care club reviews
smile lines
smile makeover
smile makeover cost
smilecareclub
smoothbeam laser
smoothshapes
sono bello
sono bello reviews
sonobella
spider vein treatment
spinal injury lawyers new york
spironolactone acne
spironolactone for acne
storage and decay containers
stretch mark laser removal
stretch mark removal
stretch marks
stretch marks before and after
sun damage repair products
sunken eyes
surgical bra
sutton foster
symmastia
tattoo eyeliner
tattoo laser removal cost
tattoo removal
tattoo removal before and after
tattoo removal cost
tattoo removal cream
tattoo removal omaha
tca
tca cross
tca peel
tca peeling
tear trough
tear trough deformity
tear trough filler
teeth bleaching cost
teeth braces
teeth whitening
teeth whitening before and after
teeth whitening cost
teeth whitening reviews
teosyal
tetanus
texas rhinoplasty
texas vaginoplasty
thermage
thermage before and after
thermage cpt
thermage reviews
thermage vs accent
thermi rf
thermismooth
thermitight
thigh lift
thread lift
tickle lipo
tickle lipo cost
tickle lipo reviews
tip rhinoplasty
toby sheldon
tooth implant cost
tooth pain after filling
tooth sensitivity after filling
traction alopecia
transconjunctival blepharoplasty
tumescent liposuction
tummy
tummy tuck
tummy tuck alternative
tummy tuck before and after
tummy tuck belt
tummy tuck belt reviews
tummy tuck cost
tummy tuck houston
tummy tuck recovery
tummy tuck scar
tummy tuck westchester
tummy tucker
tummy tucks
tummytuck
tupler technique
turbinate reduction
turkey neck
types of liposuction
ulthera
ultherapy
ultherapy cost
ultherapy reviews
ultrashape
ultrashape v3
ultrasonic cavitation
ultrasonic cavitation reviews
ultrasonic liposuction
ultrasound cavitation
under eye bags
under eye fillers
under eye wrinkles
underbite braces
v beam
v beam laser
vaginoplasty
vaginoplasty before and after
vaginoplasty cost
vaginoplasty houston
vaginoplasty riverdale
vaginoplasty texas
vampire face lift
vampire facelift
vanquish
vanquish fat reduction
varicose veins
vaser
vaser lipo
vaser lipo cost
vaser liposelection
vaser liposuction
vbeam
velashape
velashape ii reviews
velashape iii
velashape reviews
velasmooth
venus freeze
venus freeze treatment
venus legacy
vertical short incision face lift
vi peel
vipeel
viper
vivera
voluma
weak chin
weight loss shot
what does botox do
what is dysport
what is ipl
what is laser hair removal
what is laser lipo
what is rhinoplasty
what is ultherapy
whats the
whats vaginoplasty
white stretch marks
whitening injection
worth it
wrap it
wrap it works
wrinkle treatment
wrinkles around eyes
write a review
xeomin
xeomin vs botox
yag laser
yahoo.com
yellow bruise
zeltiq
zeltiq coolsculpting
zerona
zerona reviews
zoom bleaching';

			$exp = explode("\n", $str);

			for($i=0;$i<count($exp);$i++) {
				// str_replace(search, replace, subject)
				$term = trim(str_replace(' ', '-', $exp[$i]));

				$this->db->select('id');
				$this->db->where('term', $term);
				$query = $this->db->get('keywords');

				if($query->num_rows() == 0) {
					$data = array('term' => $term);
					$this->db->insert('keywords', $data);
				}
			}
		}	
	}
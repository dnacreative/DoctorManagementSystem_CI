<?php
	if(!defined('BASEPATH')) {
		exit('No direct script access allowed');
	} else {
		function TranslateStatic($type, $lang) {
			switch($type) {
				case'home_one':

					$text = "VoyagerMed is an online marketplace for U.S. medical tourism";

					switch($lang) {
						case'zh-TW':

							$trans = "發現和旅遊的最好的醫生為您的醫療保健";
							break;

						case'pt-BR':

							$trans = "Descubra e viajar para os melhores médicos para o seu atendimento médico";
							break;

						case'ru':

							$trans = "Откройте для себя и поехать в лучших врачей для медицинской помощи";
							break;

						case'ko':

							$trans = "발견 및 의료 치료에 가장 적합한 의사 여행";
							break;

						case'es':

							$trans = "Descubre y viajar a los mejores médicos para su atención médica";
							break;

						case'de':

							$trans = "Erleben & Reisen zu den besten Ärzte für Ihre medizinische Versorgung";
							break;

						case'fr':

							$trans = "Découvrez et voyager aux meilleurs médecins pour vos soins médicaux";
							break;

						case'it':

							$trans = "Scopri e viaggiare per i migliori medici per la cura medica";
							break;

						case'ar':

							$trans = "اكتشاف والسفر إلى أفضل الأطباء للحصول على الرعاية الطبية الخاصة بك";
							break;

						case'ja':

							$trans = "発見＆あなたの医療のための最高の医者に行く";
							break;

						default:

							$trans = $text;
					}
					break;

				case'auto_one':

					$text = "What kind of procedure do you need?";

					switch($lang) {
						case'zh-TW':

							$trans = "你需要什麼樣的手續？";
							break;

						case'pt-BR':

							$trans = "Que tipo de procedimento que você precisa?";
							break;

						case'ru':

							$trans = "Какие процедуры вам нужно?";
							break;

						case'ko':

							$trans = "당신은 과정의 어떤 종류가 필요합니까?";
							break;

						case'es':

							$trans = "¿Qué tipo de procedimiento se puede pedir?";
							break;

						case'de':

							$trans = "Welche Vorgehensweise benötigen Sie?";
							break;

						case'fr':

							$trans = "Quelle est la procédure avez-vous besoin?";
							break;

						case'it':

							$trans = "Che tipo di procedura avete bisogno?";
							break;

						case'ar':

							$trans = "ما هو نوع الإجراء الذي تحتاج إليه؟";
							break;

						case'ja':

							$trans = "あなたは手続きはどのような必要なのですか？";
							break;

						default:

							$trans = $text;
					}
					break;

				case'auto_two':

					$text = "Where do you want to go?";

					switch($lang) {
						case'zh-TW':

							$trans = "你想去哪裡去了？";
							break;

						case'pt-BR':

							$trans = "Para onde voce quer ir?";
							break;

						case'ru':

							$trans = "Куда ты хочешь пойти?";
							break;

						case'ko':

							$trans = "당신은 어디 가고 싶어합니까?";
							break;

						case'es':

							$trans = "Donde quieres ir?";
							break;

						case'de':

							$trans = "Wohin willst du?";
							break;

						case'fr':

							$trans = "Où veux-tu aller?";
							break;

						case'it':

							$trans = "Dove vuoi andare?";
							break;

						case'ar':

							$trans = "الى اين تريد الذهاب؟";
							break;

						case'ja':

							$trans = "どこに行きたいですか？";
							break;

						default:

							$trans = $text;
					}
					break;

				case'doctors':

					$text = 'Doctors';

					switch($lang) {
						case'zh-TW':

							$trans = "醫生";
							break;

						case'pt-BR':

							$trans = "Médicos";
							break;

						case'ru':

							$trans = "Врачи";
							break;

						case'ko':

							$trans = "의사";
							break;

						case'es':

							$trans = "Médicos";
							break;

						case'de':

							$trans = "Ärzte";
							break;

						case'fr':

							$trans = "Les Médecins";
							break;

						case'it':

							$trans = "Medici";
							break;

						case'ar':

							$trans = "الأطباء";
							break;

						case'ja':

							$trans = "ドクターズ";
							break;

						default:

							$trans = $text;
					}
					break;

				case'home_two':

					$text = "Quality, access and cost";
					
					$text = "Find U.S. doctors in places that are sensitive to you and your budget";

					switch($lang) {
						case'zh-TW':

							$trans = "找到我們卓越中心是您和預算敏感的地方";
							break;

						case'pt-BR':

							$trans = "Encontre-nos centros de excelência em lugares que são sensíveis ao seu & orçamento";
							break;

						case'ru':

							$trans = "Как нас найти центры передового опыта в таких местах, которые являются чувствительными к вашей & бюджета";
							break;

						case'ko':

							$trans = "당신의 및 예산에 민감한 장소에서 미국 우수 센터 찾기";
							break;

						case'es':

							$trans = "Encuentra estadounidense centros de excelencia en los lugares que son sensibles a su presupuesto y";
							break;

						case'de':

							$trans = "Finden Sie uns Kompetenzzentren an Orten, die empfindlich auf Ihrem & Budget";
							break;

						case'fr':

							$trans = "Retrouvez-nous des centres d'excellence dans des endroits qui sont sensibles à votre & Budget";
							break;

						case'it':

							$trans = "Trova Uniti centri di eccellenza in luoghi che sono sensibili al vostro budget &";
							break;

						case'ar':

							$trans = "البحث عن الولايات المتحدة مراكز التميز في الأماكن التي تعتبر حساسة لميزانيتك و";
							break;

						case'ja':

							$trans = "あなた＆予算に敏感な場所で米国の卓越性のセンターを検索";
							break;

						default:

							$trans = $text;
					}
					break;

				case'home_three';

					$text = "Search for doctors";

					switch($lang) {
						case'zh-TW':

							$trans = "搜索醫生";
							break;

						case'pt-BR':

							$trans = "Procure por médicos";
							break;

						case'ru':

							$trans = "Поиск для врачей";
							break;

						case'ko':

							$trans = "의사 검색";
							break;

						case'es':

							$trans = "Busque médicos";
							break;

						case'de':

							$trans = "Suche nach Ärzten";
							break;

						case'fr':

							$trans = "Recherche médecins";
							break;

						case'it':

							$trans = "Cerca per i medici";
							break;

						case'ar':

							$trans = "البحث عن الأطباء";
							break;

						case'ja':

							$trans = "医師を検索する";
							break;

						default:

							$trans = $text;
					}
					break;

				case'privacy';

					$text = "Our Privacy Policy and Terms of Use";

					switch($lang) {
						case'zh-TW':

							$trans = "我們的隱私政策和使用條款";
							break;

						case'pt-BR':

							$trans = "A nossa Política de Privacidade e Termos de Uso";
							break;

						case'ru':

							$trans = "Наша политика конфиденциальности и условия использования";
							break;

						case'ko':

							$trans = "개인 정보 보호 정책 및 이용 약관";
							break;

						case'es':

							$trans = "Nuestra Política de Privacidad y Condiciones de Uso";
							break;

						case'de':

							$trans = "Unsere Datenschutzrichtlinien und Nutzungsbedingungen";
							break;

						case'fr':

							$trans = "Notre politique de confidentialité et Conditions d'utilisation";
							break;

						case'it':

							$trans = "La nostra informativa sulla privacy e Condizioni di utilizzo";
							break;

						case'ar':

							$trans = "سياسة الخصوصية وشروط الاستخدام";
							break;

						case'ja':

							$trans = "私たちのプライバシーポリシーと利用規約";
							break;

						default:

							$trans = $text;
					}
					break;

				case'contact':

					$text = 'Contact Info';

					switch($lang) {
						case'zh-TW':

							$trans = "聯繫方式";
							break;

						case'pt-BR':

							$trans = "Informação De Contacto";
							break;

						case'ru':

							$trans = "Контактная Информация";
							break;

						case'ko':

							$trans = "연락처 정보";
							break;

						case'es':

							$trans = "Datos De Contacto";
							break;

						case'de':

							$trans = "Kontaktinformation";
							break;

						case'fr':

							$trans = "Informations De Contact";
							break;

						case'it':

							$trans = "Informazioni Di Contatto";
							break;

						case'ar':

							$trans = "معلومات الاتصال";
							break;

						case'ja':

							$trans = "問い合わせ情報";
							break;

						default:

							$trans = $text;
					}
					break;

				case'address':

					$text = "address";
					
					switch($lang) {
						case'zh-TW':

							$trans = "地址";
							break;

						case'pt-BR':

							$trans = "endereço";
							break;

						case'ru':

							$trans = "адрес";
							break;

						case'ko':

							$trans = "주소";
							break;

						case'es':

							$trans = "dirección";
							break;

						case'de':

							$trans = "die anschrift";
							break;

						case'fr':

							$trans = "adresse";
							break;

						case'it':

							$trans = "indirizzo";
							break;

						case'ar':

							$trans = "محل الاقامه";
							break;

						case'ja':

							$trans = "アドレス";
							break;

						default:

							$trans = $text;
					}
					break;	

				case'city':

					$text = "city";

					switch($lang) {
						case'zh-TW':

							$trans = "城市";
							break;

						case'pt-BR':

							$trans = "cidade";
							break;

						case'ru':

							$trans = "город";
							break;

						case'ko':

							$trans = "도시";
							break;

						case'es':

							$trans = "ciudad";
							break;

						case'de':

							$trans = "Stadt";
							break;

						case'fr':

							$trans = "ville";
							break;

						case'it':

							$trans = "città";
							break;

						case'ar':

							$trans = "مدينة";
							break;

						case'ja':

							$trans = "街";
							break;

						default:

							$trans = $text;
					}
					break;

				case'state';

					$text = "state";

					switch($lang) {
						case'zh-TW':

							$trans = "狀態";
							break;

						case'pt-BR':

							$trans = "estado";
							break;

						case'ru':

							$trans = "состояние";
							break;

						case'ko':

							$trans = "상태";
							break;

						case'es':

							$trans = "estado";
							break;

						case'de':

							$trans = "Zustand";
							break;

						case'fr':

							$trans = "état";
							break;

						case'it':

							$trans = "stato";
							break;

						case'ar':

							$trans = "دولة";
							break;

						case'ja':

							$trans = "状態";
							break;

						default:

							$trans = $text;
					}
					break;

				case'bio':

					$text = "Biography";

					switch($lang) {
						case'zh-TW':

							$trans = "傳記";
							break;

						case'pt-BR':

							$trans = "Biografia";
							break;

						case'ru':

							$trans = "Биография";
							break;

						case'ko':

							$trans = "전기";
							break;

						case'es':

							$trans = "Biografia De";
							break;

						case'de':

							$trans = "Biographie";
							break;

						case'fr':

							$trans = "Biographie";
							break;

						case'it':

							$trans = "Biografia";
							break;

						case'ar':

							$trans = "سيرة ذاتية";
							break;

						case'ja':

							$trans = "バイオグラフィー";
							break;

						default:

							$trans = $text;
					}
					break;

				case'edu':

					$text = "Education";

					switch($lang) {
						case'zh-TW':

							$trans = "教育";
							break;

						case'pt-BR':

							$trans = "Educação";
							break;

						case'ru':

							$trans = "Образование";
							break;

						case'ko':

							$trans = "교육";
							break;

						case'es':

							$trans = "La Educacion";
							break;

						case'de':

							$trans = "Die Erziehung";
							break;

						case'fr':

							$trans = "Éducation";
							break;

						case'it':

							$trans = "Formazione Scolastica";
							break;

						case'ar':

							$trans = "تربية وتعليم";
							break;

						case'ja':

							$trans = "教育";
							break;

						default:

							$trans = $text;
					}
					break;

				case'professional':

					$text = "Professional Affiliations";

					switch($lang) {
						case'zh-TW':

							$trans = "社會兼職";
							break;

						case'pt-BR':

							$trans = "Filiações profissionais";
							break;

						case'ru':

							$trans = "Членство в профессиональных организациях";
							break;

						case'ko':

							$trans = "전문 제휴";
							break;

						case'es':

							$trans = "Afiliaciones Profesionales";
							break;

						case'de':

							$trans = "Mitgliedschaften";
							break;

						case'fr':

							$trans = "Associations professionnelles";
							break;

						case'it':

							$trans = "Affiliazioni professionali";
							break;

						case'ar':

							$trans = "الانتماءات المهنية";
							break;

						case'ja':

							$trans = "プロフェッショナルアフィリエーション";
							break;

						default:

							$trans = $text;
					}
					break;


				case'insurance':

					$text = "Insurance Accepted";

					switch($lang) {
						case'zh-TW':

							$trans = "保險接受";
							break;

						case'pt-BR':

							$trans = "Insurance Accepted";
							break;

						case'ru':

							$trans = "Страхование Принято";
							break;

						case'ko':

							$trans = "보험 허용";
							break;

						case'es':

							$trans = "Acepta Seguro";
							break;

						case'de':

							$trans = "Versicherung Accepted";
							break;

						case'fr':

							$trans = "Assurance acceptée";
							break;

						case'it':

							$trans = "Assicurazione Accepted";
							break;

						case'ar':

							$trans = "التأمين مقبول";
							break;

						case'ja':

							$trans = "保険承認";
							break;

						default:

							$trans = $text;
					}
					break;

				case'hospital':

					$text = "Hospital Affiliations";
					
					switch($lang) {
						case'zh-TW':

							$trans = "醫院兼職";
							break;

						case'pt-BR':

							$trans = "Hospital Filiações";
							break;

						case'ru':

							$trans = "Больничные Членство";
							break;

						case'ko':

							$trans = "병원 제휴";
							break;

						case'es':

							$trans = "Afiliaciones del hospital";
							break;

						case'de':

							$trans = "Krankenhaus Mitgliedschaften";
							break;

						case'fr':

							$trans = "Affiliations Hôpital";
							break;

						case'it':

							$trans = "Ospedale Affiliazioni";
							break;

						case'ar':

							$trans = "الانتماءات المستشفى";
							break;

						case'ja':

							$trans = "病院アフィリエーション";
							break;

						default:

							$trans = $text;
					}
					break;

				case'phone':

					$text = "phone";
					
					switch($lang) {
						case'zh-TW':

							$trans = "電話";
							break;

						case'pt-BR':

							$trans = "telefone";
							break;

						case'ru':

							$trans = "телефон";
							break;

						case'ko':

							$trans = "전화";
							break;

						case'es':

							$trans = "teléfono";
							break;

						case'de':

							$trans = "Telefon";
							break;

						case'fr':

							$trans = "téléphone portable";
							break;

						case'it':

							$trans = "telefono";
							break;

						case'ar':

							$trans = "هاتف";
							break;

						case'ja':

							$trans = "電話";
							break;

						default:

							$trans = $text;
					}
					break;

				case'hotels':

					$text = "Hotels near Doctor's office";
					
					switch($lang) {
						case'zh-TW':

							$trans = "附近的醫生的辦公室酒店";
							break;

						case'pt-BR':

							$trans = "Hotéis perto do escritório do doutor";
							break;

						case'ru':

							$trans = "Отели рядом кабинете врача";
							break;

						case'ko':

							$trans = "의사의 사무실 근처 호텔";
							break;

						case'es':

							$trans = "Hoteles cerca de la oficina del doctor";
							break;

						case'de':

							$trans = "Hotels in der Nähe Arztpraxis";
							break;

						case'fr':

							$trans = "Hôtels près du bureau du médecin";
							break;

						case'it':

							$trans = "Hotel vicino ufficio del medico";
							break;

						case'ar':

							$trans = "فنادق بالقرب من مكتب الطبيب";
							break;

						case'ja':

							$trans = "医師のオフィス近くのホテル";
							break;

						default:

							$trans = $text;
					}
					break;

				case'ami':

					$text = "Awards, Memberships and Interests";
					
					switch($lang) {
						case'zh-TW':

							$trans = "獎，成員和利益";
							break;

						case'pt-BR':

							$trans = "Prêmios, Associações e Interesses";
							break;

						case'ru':

							$trans = "Награды, членство и интересы";
							break;

						case'ko':

							$trans = "상, 멤버십 및 관심사";
							break;

						case'es':

							$trans = "Premios, Membresías y Intereses";
							break;

						case'de':

							$trans = "Auszeichnungen, Mitgliedschaften und Interessen";
							break;

						case'fr':

							$trans = "Récompenses, affiliations et intérêts";
							break;

						case'it':

							$trans = "Premi, Associazioni e Interessi";
							break;

						case'ar':

							$trans = "الجوائز، عضوية والهوايات";
							break;

						case'ja':

							$trans = "受賞者は、メンバーシップや関心";
							break;

						default:

							$trans = $text;
					}
					break;

				case'search':

					$text = "Search";
					
					switch($lang) {
						case'zh-TW':

							$trans = "搜索";
							break;

						case'pt-BR':

							$trans = "pesquisa";
							break;

						case'ru':

							$trans = "поиск";
							break;

						case'ko':

							$trans = "수색";
							break;

						case'es':

							$trans = "búsqueda";
							break;

						case'de':

							$trans = "Suche";
							break;

						case'fr':

							$trans = "recherche";
							break;

						case'it':

							$trans = "ricerca";
							break;

						case'ar':

							$trans = "بحث";
							break;

						case'ja':

							$trans = "検索";
							break;

						default:

							$trans = $text;
					}
					break;

				case'destinations':

					$text = "Destinations";
					
					switch($lang) {
						case'zh-TW':

							$trans = "目的地";
							break;

						case'pt-BR':

							$trans = "destinos";
							break;

						case'ru':

							$trans = "направления";
							break;

						case'ko':

							$trans = "목적지";
							break;

						case'es':

							$trans = "destinos";
							break;

						case'de':

							$trans = "Destinationen";
							break;

						case'fr':

							$trans = "destinations";
							break;

						case'it':

							$trans = "destinazioni";
							break;

						case'ar':

							$trans = "الأماكن";
							break;

						case'ja':

							$trans = "目的地";
							break;

						default:

							$trans = $text;
					}
					break;

				case'see_more':

					$text = "see more";
					
					switch($lang) {
						case'zh-TW':

							$trans = "";
							break;

						case'pt-BR':

							$trans = "";
							break;

						case'ru':

							$trans = "";
							break;

						case'ko':

							$trans = "";
							break;

						case'es':

							$trans = "";
							break;

						case'de':

							$trans = "";
							break;

						case'fr':

							$trans = "";
							break;

						case'it':

							$trans = "";
							break;

						case'ar':

							$trans = "";
							break;

						case'ja':

							$trans = "";
							break;

						default:

							$trans = $text;
					}
					break;

				case'':

					$text = "";
					
					switch($lang) {
						case'zh-TW':

							$trans = "";
							break;

						case'pt-BR':

							$trans = "";
							break;

						case'ru':

							$trans = "";
							break;

						case'ko':

							$trans = "";
							break;

						case'es':

							$trans = "";
							break;

						case'de':

							$trans = "";
							break;

						case'fr':

							$trans = "";
							break;

						case'it':

							$trans = "";
							break;

						case'ar':

							$trans = "";
							break;

						case'ja':

							$trans = "";
							break;

						default:

							$trans = $text;
					}
					break;

				default:

					$trans = $text;
			}

			return $trans;
		}
	}

					/*
				case'':

					$text = "";
					
					switch($lang) {
						case'zh-TW':

							$trans = "";
							break;

						case'pt-BR':

							$trans = "";
							break;

						case'ru':

							$trans = "";
							break;

						case'ko':

							$trans = "";
							break;

						case'es':

							$trans = "";
							break;

						case'de':

							$trans = "";
							break;

						case'fr':

							$trans = "";
							break;

						case'it':

							$trans = "";
							break;

						case'ar':

							$trans = "";
							break;

						case'ja':

							$trans = "";
							break;

						default:

							$trans = $text;
					}
					break;
					*/
?>
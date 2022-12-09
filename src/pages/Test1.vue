<template>
  <div class="bg-gray-50 min-w-screen min-h-screen flex justify-center items-center">
    <div class="max-w-xs relative space-y-3">
      <label
        for="search"
        class="text-gray-900"
      >
        Type the name of a country to search
      </label>

      <input
        type="text"
        id="search"
        v-model="searchTerm"
        placeholder="Type here..."
        class="p-3 mb-0.5 w-full border border-gray-300 rounded"
      >

      <ul
        v-if="searchCountries.length"
        class="w-full rounded bg-white border border-gray-300 px-4 py-2 space-y-1 absolute z-10"
      >
        <li class="px-1 pt-1 pb-2 font-bold border-b border-gray-200">
          Showing {{ searchCountries.length }} of {{ countries.length }} results
        </li>
        <li
            v-for="country in searchCountries"
            :key="country.name"
            @click="selectCountry(country.name)"
            class="cursor-pointer hover:bg-gray-100 p-1"
        >
          {{ country.name }}
        </li>
      </ul>

      <p
        v-if="selectedCountry"
        class="text-lg pt-2 absolute"
      >
        You have selected: <span class="font-semibold">{{ selectedCountry }}</span>
      </p>
    </div>
  </div>
</template>

<script>
import lib from '@/lib';
import { useMeta } from 'vue-meta';
import { ref } from 'vue';

export default {
	name: 'Test1',
	mixins: lib.mixins,
	setup(){
		useMeta({title: 'Test1 | Krasp'});
	},
	data(){
		return {
			searchTerm: '',
			selectedCountry: '',
			
			countries: [
				{"name": "Albania"},
				{"name": "Åland Islands"},
				{"name": "Algeria"},
				{"name": "American Samoa"},
				{"name": "Andorra"},
				{"name": "Angola"},
				{"name": "Anguilla"},
				{"name": "Antarctica"},
				{"name": "Antigua and Barbuda"},
				{"name": "Argentina"},
				{"name": "Armenia"},
				{"name": "Aruba"},
				{"name": "Australia"},
				{"name": "Austria"},
				{"name": "Azerbaijan"},
				{"name": "Bahamas (the)"},
				{"name": "Bahrain"},
				{"name": "Bangladesh"},
				{"name": "Barbados"},
				{"name": "Belarus"},
				{"name": "Belgium"},
				{"name": "Belize"},
				{"name": "Benin"},
				{"name": "Bermuda"},
				{"name": "Bhutan"},
				{"name": "Bolivia (Plurinational State of)"},
				{"name": "Bonaire, Sint Eustatius and Saba"},
				{"name": "Bosnia and Herzegovina"},
				{"name": "Botswana"},
				{"name": "Bouvet Island"},
				{"name": "Brazil"},
				{"name": "British Indian Ocean Territory (the)"},
				{"name": "Brunei Darussalam"},
				{"name": "Bulgaria"},
				{"name": "Burkina Faso"},
				{"name": "Burundi"},
				{"name": "Cabo Verde"},
				{"name": "Cambodia"},
				{"name": "Cameroon"},
				{"name": "Canada"},
				{"name": "Cayman Islands (the)"},
				{"name": "Central African Republic (the)"},
				{"name": "Chad"},
				{"name": "Chile"},
				{"name": "China"},
				{"name": "Christmas Island"},
				{"name": "Cocos (Keeling) Islands (the)"},
				{"name": "Colombia"},
				{"name": "Comoros (the)"},
				{"name": "Congo (the Democratic Republic of the)"},
				{"name": "Congo (the)"},
				{"name": "Cook Islands (the)"},
				{"name": "Costa Rica"},
				{"name": "Croatia"},
				{"name": "Cuba"},
				{"name": "Curaçao"},
				{"name": "Cyprus"},
				{"name": "Czechia"},
				{"name": "Côte d'Ivoire"},
				{"name": "Denmark"},
				{"name": "Djibouti"},
				{"name": "Dominica"},
				{"name": "Dominican Republic (the)"},
				{"name": "Ecuador"},
				{"name": "Egypt"},
				{"name": "El Salvador"},
				{"name": "Equatorial Guinea"},
				{"name": "Eritrea"},
				{"name": "Estonia"},
				{"name": "Eswatini"},
				{"name": "Ethiopia"},
				{"name": "Falkland Islands (the) [Malvinas]"},
				{"name": "Faroe Islands (the)"},
				{"name": "Fiji"},
				{"name": "Finland"},
				{"name": "France"},
				{"name": "French Guiana"},
				{"name": "French Polynesia"},
				{"name": "French Southern Territories (the)"},
				{"name": "Gabon"},
				{"name": "Gambia (the)"},
				{"name": "Georgia"},
				{"name": "Germany"},
				{"name": "Ghana"},
				{"name": "Gibraltar"},
				{"name": "Greece"},
				{"name": "Greenland"},
				{"name": "Grenada"},
				{"name": "Guadeloupe"},
				{"name": "Guam"},
				{"name": "Guatemala"},
				{"name": "Guernsey"},
				{"name": "Guinea"},
				{"name": "Guinea-Bissau"},
				{"name": "Guyana"},
				{"name": "Haiti"},
				{"name": "Heard Island and McDonald Islands"},
				{"name": "Holy See (the)"},
				{"name": "Honduras"},
				{"name": "Hong Kong"},
				{"name": "Hungary"},
				{"name": "Iceland"},
				{"name": "India"},
				{"name": "Indonesia"},
				{"name": "Iran (Islamic Republic of)"},
				{"name": "Iraq"},
				{"name": "Ireland"},
				{"name": "Isle of Man"},
				{"name": "Israel"},
				{"name": "Italy"},
				{"name": "Jamaica"},
				{"name": "Japan"},
				{"name": "Jersey"},
				{"name": "Jordan"},
				{"name": "Kazakhstan"},
				{"name": "Kenya"},
				{"name": "Kiribati"},
				{"name": "Korea (the Democratic People's Republic of)"},
				{"name": "Korea (the Republic of)"},
				{"name": "Kuwait"},
				{"name": "Kyrgyzstan"},
				{"name": "Lao People's Democratic Republic (the)"},
				{"name": "Latvia"},
				{"name": "Lebanon"},
				{"name": "Lesotho"},
				{"name": "Liberia"},
				{"name": "Libya"},
				{"name": "Liechtenstein"},
				{"name": "Lithuania"},
				{"name": "Luxembourg"},
				{"name": "Macao"},
				{"name": "Madagascar"},
				{"name": "Malawi"},
				{"name": "Malaysia"},
				{"name": "Maldives"},
				{"name": "Mali"},
				{"name": "Malta"},
				{"name": "Marshall Islands (the)"},
				{"name": "Martinique"},
				{"name": "Mauritania"},
				{"name": "Mauritius"},
				{"name": "Mayotte"},
				{"name": "Mexico"},
				{"name": "Micronesia (Federated States of)"},
				{"name": "Moldova (the Republic of)"},
				{"name": "Monaco"},
				{"name": "Mongolia"},
				{"name": "Montenegro"},
				{"name": "Montserrat"},
				{"name": "Morocco"},
				{"name": "Mozambique"},
				{"name": "Myanmar"},
				{"name": "Namibia"},
				{"name": "Nauru"},
				{"name": "Nepal"},
				{"name": "Netherlands (the)"},
				{"name": "New Caledonia"},
				{"name": "New Zealand"},
				{"name": "Nicaragua"},
				{"name": "Niger (the)"},
				{"name": "Nigeria"},
				{"name": "Niue"},
				{"name": "Norfolk Island"},
				{"name": "Northern Mariana Islands (the)"},
				{"name": "Norway"},
				{"name": "Oman"},
				{"name": "Pakistan"},
				{"name": "Palau"},
				{"name": "Palestine, State of"},
				{"name": "Panama"},
				{"name": "Papua New Guinea"},
				{"name": "Paraguay"},
				{"name": "Peru"},
				{"name": "Philippines (the)"},
				{"name": "Pitcairn"},
				{"name": "Poland"},
				{"name": "Portugal"},
				{"name": "Puerto Rico"},
				{"name": "Qatar"},
				{"name": "Republic of North Macedonia"},
				{"name": "Romania"},
				{"name": "Russian Federation (the)"},
				{"name": "Rwanda"},
				{"name": "Réunion"},
				{"name": "Saint Barthélemy"},
				{"name": "Saint Helena, Ascension and Tristan da Cunha"},
				{"name": "Saint Kitts and Nevis"},
				{"name": "Saint Lucia"},
				{"name": "Saint Martin (French part)"},
				{"name": "Saint Pierre and Miquelon"},
				{"name": "Saint Vincent and the Grenadines"},
				{"name": "Samoa"},
				{"name": "San Marino"},
				{"name": "Sao Tome and Principe"},
				{"name": "Saudi Arabia"},
				{"name": "Senegal"},
				{"name": "Serbia"},
				{"name": "Seychelles"},
				{"name": "Sierra Leone"},
				{"name": "Singapore"},
				{"name": "Sint Maarten (Dutch part)"},
				{"name": "Slovakia"},
				{"name": "Slovenia"},
				{"name": "Solomon Islands"},
				{"name": "Somalia"},
				{"name": "South Africa"},
				{"name": "South Georgia and the South Sandwich Islands"},
				{"name": "South Sudan"},
				{"name": "Spain"},
				{"name": "Sri Lanka"},
				{"name": "Sudan (the)"},
				{"name": "Suriname"},
				{"name": "Svalbard and Jan Mayen"},
				{"name": "Sweden"},
				{"name": "Switzerland"},
				{"name": "Syrian Arab Republic"},
				{"name": "Taiwan (Province of China)"},
				{"name": "Tajikistan"},
				{"name": "Tanzania, United Republic of"},
				{"name": "Thailand"},
				{"name": "Timor-Leste"},
				{"name": "Togo"},
				{"name": "Tokelau"},
				{"name": "Tonga"},
				{"name": "Trinidad and Tobago"},
				{"name": "Tunisia"},
				{"name": "Turkey"},
				{"name": "Turkmenistan"},
				{"name": "Turks and Caicos Islands (the)"},
				{"name": "Tuvalu"},
				{"name": "Uganda"},
				{"name": "Ukraine"},
				{"name": "United Arab Emirates (the)"},
				{"name": "United Kingdom of Great Britain and Northern Ireland (the)"},
				{"name": "United States Minor Outlying Islands (the)"},
				{"name": "United States of America (the)"},
				{"name": "Uruguay"},
				{"name": "Uzbekistan"},
				{"name": "Vanuatu"},
				{"name": "Venezuela (Bolivarian Republic of)"},
				{"name": "Viet Nam"},
				{"name": "Virgin Islands (British)"},
				{"name": "Virgin Islands (U.S.)"},
				{"name": "Wallis and Futuna"},
				{"name": "Western Sahara"},
				{"name": "Yemen"},
				{"name": "Zambia"},
				{"name": "Zimbabwe", "code": "ZW"}
			],
		};
	},
	computed: {
		searchCountries(){
			if (this.searchTerm === '') {
				return []
			}
			let matches = 0
			return this.countries.filter(country => {
				if (country.name.toLowerCase().includes(this.searchTerm.toLowerCase()) && matches < 10) {
					matches++
					return country
				}
			})
		},
	},
	methods: {
		selectCountry(country){
			this.selectedCountry = country
			this.searchTerm = ''
		},
	},
	beforeMount(){
		window.scrollTo(0, 0);
	},
	beforeRouteUpdate(to, from, next){
		next();
		window.scrollTo(0, 0);
	},
	components: {
		//Navbar,
	},
}
</script>
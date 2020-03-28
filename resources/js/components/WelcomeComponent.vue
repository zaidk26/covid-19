<template>
  <div>
    <div class="container mt-4 text-center">
      <div class="row">
        <div class="col">
          <div class="card" style="background:transparent;">
            <div class="card-body">
              <small class="text-black-50 font-percent">UPDATED AT</small>
              <p class="m-0"><strong> {{ updatedAt }}</strong></p>
            </div>
          </div>           
        </div>
      </div>
    </div>
   

    <main class="mb-3 mt-0">
      <div class="container">

        <div class="row mt-3">
          <div class="col">
            <div class="card">
              <div class="card-header bg-white">
                <div class="row no-gutters">
                  <div class="col-auto">
                    <img :src="selectedCountry.flag" height="26" class="mr-1" :alt="selectedCountry.name" />
                  </div>
                  <div class="col">
                    <select
                      v-model="selectedCountry"
                      class="form-control form-control-sm"
                      @change="onChangeCountry()"
                    >
                      <option
                        v-for="country in countriesList"
                        :key="country.id"
                        :value="country"
                        >{{ country.name }}</option
                      >
                    </select>
                  </div>
                </div>
              </div>

              <div class="card-body">
                <div class="row">
                  <div class="col my-auto">
                    <div class="border-bottom my-2">TODAY'S STATS</div>
                    <div class="stat-row">
                      <div class="row">
                        <div class="col-auto">
                          <p class="text-secodary font-weight-bold">Cases</p>
                        </div>
                        <div class="col text-right">
                          <h5>
                            {{
                              new Intl.NumberFormat().format(countryCasesToday)
                            }}
                          </h5>
                        </div>
                      </div>
                    </div>

                    <div class="stat-row">
                      <div class="row">
                        <div class="col-auto">
                          <p class="text-danger font-weight-bold">Deaths</p>
                        </div>
                        <div class="col text-right">
                          <h5 class="text-danger">
                            <small
                              class="text-black-50 font-percent"
                              v-show="countryCasesToday > 0"
                              >({{
                                (
                                  (countryDeathsToday / countryCasesToday) *
                                  100
                                ).toFixed(2)
                              }}%)</small
                            >
                            {{
                              new Intl.NumberFormat().format(countryDeathsToday)
                            }}
                          </h5>
                        </div>
                      </div>
                    </div>

                    <div class="border-bottom mb-2 mt-4">ALL TIME STATS</div>
                    <div class="stat-row">
                      <div class="row">
                        <div class="col-auto">
                          <p class="text-secodary font-weight-bold">Cases</p>
                        </div>
                        <div class="col text-right">
                          <h5>
                            {{ new Intl.NumberFormat().format(countryCases) }}
                          </h5>
                        </div>
                      </div>
                    </div>

                    <div class="stat-row">
                      <div class="row">
                        <div class="col-auto">
                          <p class="text-danger font-weight-bold">Deaths</p>
                        </div>
                        <div class="col text-right">
                          <h5 class="text-danger">
                            <small class="text-black-50 font-percent"
                              >({{
                                ((countryDeaths / countryCases) * 100).toFixed(
                                  2
                                )
                              }}%)</small
                            >
                            {{ new Intl.NumberFormat().format(countryDeaths) }}
                          </h5>
                        </div>
                      </div>
                    </div>

                    <div class="stat-row">
                        <div class="row">
                          <div class="col-auto my-auto">
                            <p class="text-success font-weight-bold">
                              Recovered
                            </p>
                          </div>
                          <div class="col text-right">
                            <h5 class="m-0 text-success">
                              <small class="text-black-50 font-percent m-0"
                                >({{
                                  (
                                    (countryRecovered / countryCases) *
                                    100
                                  ).toFixed(2)
                                }}%)</small
                              >
                              {{
                                new Intl.NumberFormat().format(countryRecovered)
                              }}
                            </h5>
                          </div>
                        </div>
                      </div>

                    <div class="mt-3">
                      <a
                        v-show="!countryInfoToggle"
                        v-on:click="toggleCountryInfo"
                        class="btn btn-sm btn-success text-white"
                        >+more info</a
                      >
                    </div>

                    <div v-show="countryInfoToggle">
                      

                      <div class="stat-row">
                        <div class="row">
                          <div class="col-auto">
                            <p class="text-secondary font-weight-bold">
                              Active Cases
                            </p>
                          </div>
                          <div class="col text-right">
                            <h5>
                              {{
                                new Intl.NumberFormat().format(countryActive)
                              }}
                            </h5>
                          </div>
                        </div>
                      </div>

                      <div class="stat-row">
                        <div class="row">
                          <div class="col-auto">
                            <p class="text-secondary font-weight-bold">
                              Critical Cases
                            </p>
                          </div>
                          <div class="col text-right">
                            <h5>
                              {{
                                new Intl.NumberFormat().format(countryCritical)
                              }}
                            </h5>
                          </div>
                        </div>
                      </div>

                      <div class="stat-row">
                        <div class="row">
                          <div class="col-auto">
                            <p class="text-secondary font-weight-bold">
                              Cases Per Million
                            </p>
                          </div>
                          <div class="col text-right">
                            <h5>
                              {{
                                new Intl.NumberFormat().format(
                                  countryCasesPerMil
                                )
                              }}
                            </h5>
                          </div>
                        </div>
                      </div>

                      <div class="stat-row">
                        <div class="row">
                          <div class="col-auto">
                            <p class="text-secondary font-weight-bold">
                              Deaths Per Million
                            </p>
                          </div>
                          <div class="col text-right">
                            <h5>
                              {{
                                new Intl.NumberFormat().format(
                                  countryDeathsPerMil
                                )
                              }}
                            </h5>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row mt-5" v-if="selectedCountry.name == 'South Africa'">
          <div class="col">
            <div class="card">
              <div class="card-header bg-white">
                <h4 class="m-0">News Headlines</h4>
                <small class="text-black-50 m-0">South African Headlines</small>
              </div>
              <div class="card-body">
                <div class="stat-row" v-for="article in newsArticlesSa.slice(0,3)" :key="article.id">
                  <a :href="article.url">{{ article.title }}</a><br>
                  <small class="text-black-50 font-percentage">- {{ article.source.name }}</small>
                </div>

                <div class="mt-3">
                  <a
                    v-show="!newsSaToggle"
                    v-on:click="toggleNewsSa"
                    class="btn btn-sm btn-success text-white"
                    >+more articles</a
                  >
                </div>
                <div v-if="newsSaToggle">
                  <div class="stat-row" v-for="article in newsArticlesSa.slice(3,100)" :key="article.id" >
                    <a :href="article.url">{{ article.title }}</a><br>
                    <small class="text-black-50 font-percentage">- {{ article.source.name }}</small>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

        <!-- world Data -->
        <div class="row mt-5">
          <div class="col">
            <div class="card">
              <div class="card-header bg-white">
                <div class="row">
                  <div class="col-auto">
                    <img src="/img/world.png" alt="world" />
                  </div>
                  <div class="col-auto">
                    <h5 class="m-0 p-0">The World</h5>
                    <small class="text-muted m-0 p-0"
                      >{{ countriesAffected }} Countries affected</small
                    >
                  </div>
                </div>
              </div>

              <div class="card-body">
                <div class="row">
                  <div class="col my-auto">
                    <div class="border-bottom my-2">TODAY'S STATS</div>
                    <div class="stat-row">
                      <div class="row">
                        <div class="col-auto">
                          <p class="text-secondary font-weight-bold">Cases</p>
                        </div>
                        <div class="col text-right">
                          <h5>
                            {{
                              new Intl.NumberFormat().format(worldCasesToday)
                            }}
                          </h5>
                        </div>
                      </div>
                    </div>

                    <div class="stat-row">
                      <div class="row">
                        <div class="col-auto">
                          <p class="text-danger font-weight-bold">Deaths</p>
                        </div>
                        <div class="col text-right">
                          <h5 class="text-danger">
                            <small
                              class="text-black-50 font-percent"
                              v-show="worldCasesToday > 0"
                              >({{
                                (
                                  (worldDeathsToday / worldCasesToday) *
                                  100
                                ).toFixed(2)
                              }}%)</small
                            >
                            {{
                              new Intl.NumberFormat().format(worldDeathsToday)
                            }}
                          </h5>
                        </div>
                      </div>
                    </div>

                    <div class="border-bottom mt-4 mb-2">ALL TIME STATS</div>

                    <div class="stat-row">
                      <div class="row">
                        <div class="col-auto">
                          <p class="text-secondary font-weight-bold">Cases</p>
                        </div>
                        <div class="col text-right">
                          <h5>
                            {{ new Intl.NumberFormat().format(worldCases) }}
                          </h5>
                        </div>
                      </div>
                    </div>

                    <div class="stat-row">
                      <div class="row">
                        <div class="col-auto">
                          <p class="text-danger font-weight-bold">Deaths</p>
                        </div>
                        <div class="col text-right">
                          <h5 class="text-danger">
                            <small class="text-black-50 font-percent"
                              >({{
                                ((worldDeaths / worldCases) * 100).toFixed(2)
                              }}%)</small
                            >
                            {{ new Intl.NumberFormat().format(worldDeaths) }}
                          </h5>
                        </div>
                      </div>
                    </div>

                    <div class="stat-row">
                        <div class="row">
                          <div class="col-auto my-auto">
                            <p class="text-success font-weight-bold">
                              Recovered
                            </p>
                          </div>
                          <div class="col text-right">
                            <h5 class="m-0 text-success">
                              <small class="text-black-50 font-percent m-0"
                                >({{
                                  ((worldRecovered / worldCases) * 100).toFixed(
                                    2
                                  )
                                }}%)</small
                              >
                              {{
                                new Intl.NumberFormat().format(worldRecovered)
                              }}
                            </h5>
                          </div>
                        </div>
                      </div>

                    <div class="mt-3">
                      <a
                        v-show="!worldInfoToggle"
                        v-on:click="toggleWorldInfo"
                        class="btn btn-sm btn-success text-white"
                        >+more info</a
                      >
                    </div>

                    <div v-show="worldInfoToggle">
                      

                      <div class="stat-row">
                        <div class="row">
                          <div class="col-auto">
                            <p class="text-secondary font-weight-bold">
                              Active Cases
                            </p>
                          </div>
                          <div class="col text-right">
                            <h5>
                              {{ new Intl.NumberFormat().format(worldActive) }}
                            </h5>
                          </div>
                        </div>
                      </div>

                      <div class="stat-row">
                        <div class="row">
                          <div class="col-auto">
                            <p class="text-secondary font-weight-bold">
                              Critical Cases
                            </p>
                          </div>
                          <div class="col text-right">
                            <h5>
                              {{
                                new Intl.NumberFormat().format(worldCritical)
                              }}
                            </h5>
                          </div>
                        </div>
                      </div>

                      <div class="stat-row">
                        <div class="row">
                          <div class="col-auto">
                            <p class="text-secondary font-weight-bold">
                              Cases Per Million
                            </p>
                          </div>
                          <div class="col text-right">
                            <h5>
                              {{
                                new Intl.NumberFormat().format(worldCasesPerMil)
                              }}
                            </h5>
                          </div>
                        </div>
                      </div>

                      <div class="stat-row">
                        <div class="row">
                          <div class="col-auto">
                            <p class="text-secondary font-weight-bold">
                              Deaths Per Million
                            </p>
                          </div>
                          <div class="col text-right">
                            <h5>
                              {{
                                new Intl.NumberFormat().format(
                                  worldDeathsPerMil
                                )
                              }}
                            </h5>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- World News -->
         <div class="row mt-5">
          <div class="col">
            <div class="card">
              <div class="card-header bg-white">
                <h4 class="m-0">World News Headlines</h4>
                <small class="text-black-50 m-0">Global Headlines</small>
              </div>
              <div class="card-body">
                <div class="stat-row" v-for="article in newsArticlesWorld.slice(0,3)" :key="article.id">
                  <a :href="article.url">{{ article.title }}</a><br>
                  <small class="text-black-50 font-percentage">- {{ article.source.name }}</small>
                </div>

                <div class="mt-3">
                  <a
                    v-show="!newsWorldToggle"
                    v-on:click="toggleNewsWorld"
                    class="btn btn-sm btn-success text-white"
                    >+more articles</a
                  >
                </div>
                <div v-if="newsWorldToggle">
                  <div class="stat-row" v-for="article in newsArticlesWorld.slice(3,100)" :key="article.id" >
                    <a :href="article.url">{{ article.title }}</a><br>
                    <small class="text-black-50 font-percentage">- {{ article.source.name }}</small>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

        <!-- Top 10-->
        <div class="row mt-5">
          <div class="col">

            <div class="card">
              <div class="card-header bg-white">
                 <h4>TOP 10 COUNTRIES</h4>
                <div class="row">
                  <div class="col-auto">
                    Sort By
                  </div>
                  <div class="col">
                    <select class="form-control form-control-sm"  @change="onChangeSort($event)">
                      <option selected value="deaths">Deaths</option>
                      <option value="cases">Cases</option>
                      <option value="recovered">Recovered</option>
                      <option value="todayCases">Cases Today</option>
                      <option value="todayDeaths">Deaths Today</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>


            <div class="card mt-3" v-for="country in countriesData.slice(0,10)" :key="country.country">
              <div class="card-header bg-white">
               <div class="row">
                    <div class="col-3">
                       <img :src="country.countryInfo.flag" height="26" :alt="country.country">
                    </div>
                    <div class="col my-auto">
                      <h5>{{ country.country }}</h5>
                    </div>
                  </div>
                
                
              </div>
              <div class="card-body">                 

                  <div class="row">
                  <div class="col my-auto">
                    <div class="border-bottom my-2">TODAY'S STATS</div>
                    <div class="stat-row">
                      <div class="row">
                        <div class="col-auto">
                          <p class="text-secondary font-weight-bold">Cases</p>
                        </div>
                        <div class="col text-right">
                          <h5>
                            {{
                              new Intl.NumberFormat().format(country.todayCases)
                            }}
                          </h5>
                        </div>
                      </div>
                    </div>

                    <div class="stat-row">
                      <div class="row">
                        <div class="col-auto">
                          <p class="text-danger font-weight-bold">Deaths</p>
                        </div>
                        <div class="col text-right">
                          <h5 class="text-danger">
                            <small
                              class="text-black-50 font-percent"
                              v-show="country.todayCases > 0"
                              >({{
                                (
                                  (country.todayDeaths / country.todayCases) *
                                  100
                                ).toFixed(2)
                              }}%)</small
                            >
                            {{
                              new Intl.NumberFormat().format(country.todayDeaths)
                            }}
                          </h5>
                        </div>
                      </div>
                    </div>

                    <div class="border-bottom mb-2 mt-4">ALL TIME STATS</div>

                    <div class="stat-row">
                      <div class="row">
                        <div class="col-auto">
                          <p class="text-secondary font-weight-bold">Cases</p>
                        </div>
                        <div class="col text-right">
                          <h5>
                            {{ new Intl.NumberFormat().format(country.cases) }}
                          </h5>
                        </div>
                      </div>
                    </div>

                    <div class="stat-row">
                      <div class="row">
                        <div class="col-auto">
                          <p class="text-danger font-weight-bold">Deaths</p>
                        </div>
                        <div class="col text-right">
                          <h5 class="text-danger">
                            <small class="text-black-50 font-percent"
                              >({{
                                ((country.deaths / country.cases) * 100).toFixed(2)
                              }}%)</small
                            >
                            {{ new Intl.NumberFormat().format(country.deaths) }}
                          </h5>
                        </div>
                      </div>
                    </div>

                      <div class="stat-row">
                        <div class="row">
                          <div class="col-auto my-auto">
                            <p class="text-success font-weight-bold">
                              Recovered
                            </p>
                          </div>
                          <div class="col text-right">
                            <h5 class="m-0 text-success">
                              <small class="text-black-50 font-percent m-0"
                                >({{
                                  ((country.recovered / country.cases) * 100).toFixed(2)}}%)</small>
                              {{
                                new Intl.NumberFormat().format(country.recovered)
                              }}
                            </h5>
                          </div>
                        </div>
                      </div>

                    <div class="mt-3">
                      <a
                        v-show="!worldInfoToggle"
                        v-on:click="toggleWorldInfo"
                        class="btn btn-sm btn-success text-white"
                        >+more info</a
                      >
                    </div>

                    <div v-show="worldInfoToggle">
                    

                      <div class="stat-row">
                        <div class="row">
                          <div class="col-auto">
                            <p class="text-secondary font-weight-bold">
                              Active Cases
                            </p>
                          </div>
                          <div class="col text-right">
                            <h5>
                              {{ new Intl.NumberFormat().format(country.active) }}
                            </h5>
                          </div>
                        </div>
                      </div>

                      <div class="stat-row">
                        <div class="row">
                          <div class="col-auto">
                            <p class="text-secondary font-weight-bold">
                              Critical Cases
                            </p>
                          </div>
                          <div class="col text-right">
                            <h5>
                              {{
                                new Intl.NumberFormat().format(country.critical)
                              }}
                            </h5>
                          </div>
                        </div>
                      </div>

                      <div class="stat-row">
                        <div class="row">
                          <div class="col-auto">
                            <p class="text-secondary font-weight-bold">
                              Cases Per Million
                            </p>
                          </div>
                          <div class="col text-right">
                            <h5>
                              {{
                                new Intl.NumberFormat().format(country.casesPerOneMillion)
                              }}
                            </h5>
                          </div>
                        </div>
                      </div>

                      <div class="stat-row">
                        <div class="row">
                          <div class="col-auto">
                            <p class="text-secondary font-weight-bold">
                              Deaths Per Million
                            </p>
                          </div>
                          <div class="col text-right">
                            <h5>
                              {{
                                new Intl.NumberFormat().format(
                                  country.deathsPerOneMillion
                                )
                              }}
                            </h5>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                
              </div>
            </div>
          </div>
        </div>

       
      </div>
    </main>

    
  </div>
</template>

<script>
const covid = require("novelcovid");

export default {

  props:['newsSa','newsWorld'],

  data: function() {
    return {
      updatedAt: '',

      countriesData: [],
      countriesAffected: 0,

      countriesList: [],
      selectedCountry: { name: "South Africa", flag: null, id: 1 },

      newsArticlesSa: [],
      newsArticlesWorld: [],

      worldCases: 0,
      worldDeaths: 0,
      worldCasesToday: 0,
      worldDeathsToday: 0,
      worldActive: 0,
      worldCritical: 0,
      worldRecovered: 0,
      worldCasesPerMil: 0,
      worldDeathsPerMil: 0,

      countryCases: 0,
      countryDeaths: 0,
      countryCasesToday: 0,
      countryDeathsToday: 0,
      countryActive: 0,
      countryCritical: 0,
      countryRecovered: 0,
      countryCasesPerMil: 0,
      countryDeathsPerMil: 0,

      worldInfoToggle: false,
      countryInfoToggle: false,
      newsSaToggle: false,
      newsWorldToggle: false
    };
  },

  mounted() {
    this.getData('deaths')
    // console.log(this.newsSa);
    //  console.log(this.newsWorld);

  },

  methods: {
    getData(sort){
      
      (async () => {
        this.countriesData = await covid.getCountry({sort:sort});
        //console.log(this.countriesData);

        //World Stats
        this.countriesList = []
        this.countriesAffected = this.countriesData.length;
        this.countriesData.forEach(element => {
          this.countriesList.push({
            name: element.country,
            flag: element.countryInfo.flag,
            id: element.countryInfo._id
          });
          this.worldCases += element.cases;
          this.worldDeaths += element.deaths;
          this.worldCasesToday += element.todayCases;
          this.worldDeathsToday += element.todayDeaths;
          this.worldActive += element.active;
          this.worldCritical += element.critical;
          this.worldRecovered += element.recovered;
          this.worldCasesPerMil += element.casesPerOneMillion;
          this.worldDeathsPerMil += element.deathsPerOneMillion;
        });

        this.countriesList.sort(this.compare);

        //get world news
        this.newsWorld.articles.forEach( article => {
          this.newsArticlesWorld.push(article)
        })

        let c = this.$cookie.get('country');
        if(c != undefined && c != null){
          
          this.countriesData.forEach(element => {
            if (element.country == c) {
              this.selectedCountry.name = c;
              this.selectedCountry.flag = element.countryInfo.flag;
              this.selectedCountry.id = element.countryInfo._id;
            }
          })
          this.getCountryStats(c);

        }else{
          
          this.getCountryStats(this.selectedCountry.name);
        }      

        this.updatedAt = new Date().toString().substr(0,25)
      })();
    },
    toggleWorldInfo() {
      this.worldInfoToggle = !this.worldInfoToggle;
    },
    toggleCountryInfo() {
      this.countryInfoToggle = !this.countryInfoToggle;
    },
    toggleNewsSa() {
      this.newsSaToggle = !this.newsSaToggle;
    },
    toggleNewsWorld() {
      this.newsWorldToggle = !this.newsWorldToggle;
    },
    onChangeSort(event){
      this.getData(event.target.value)
    },
    getCountryStats(country) {     

      this.countriesData.forEach(element => {
        if (element.country == country) {

          this.selectedCountry.flag = element.countryInfo.flag;
          this.selectedCountry.id = element.countryInfo._id;

          this.countryCases = element.cases;
          this.countryDeaths = element.deaths;
          this.countryCasesToday = element.todayCases;
          this.countryDeathsToday = element.todayDeaths;
          this.countryActive = element.active;
          this.countryCritical = element.critical;
          this.countryRecovered = element.recovered;
          this.countryCasesPerMil = element.casesPerOneMillion;
          this.countryDeathsPerMil = element.deathsPerOneMillion;
        }
      });
      this.getCountryNews();
    },
    onChangeCountry() {
      this.$cookie.set('country',this.selectedCountry.name, 100);
      this.getCountryStats(this.selectedCountry.name);
    },
    getCountryNews(){
      this.newsSa.articles.forEach( article => {
        this.newsArticlesSa.push(article)
      })
    },
    compare(a, b) {
      // Use toUpperCase() to ignore character casing
      const countryA = a.name.toUpperCase();
      const countryB = b.name.toUpperCase();

      let comparison = 0;
      if (countryA > countryB) {
        comparison = 1;
      } else if (countryA < countryB) {
        comparison = -1;
      }
      return comparison;
    }
  }
};
</script>

<style scoped>

.stat-row {
  margin-bottom: 5px;
  border-bottom: solid 1px #eee;
}
.font-percent {
  font-size: 12px;
}
</style>

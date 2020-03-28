<template>
  <div>
    <header>
      <div class="container">
        <div class="row">
          <div class="col-auto">
            <img src="./../assets/virus.png" height="40" alt="corona virus" />
          </div>
          <div class="col-auto">
            <h5 class="m-0 p-0">COVID 19</h5>
            <small class="text-muted m-0">Corona Virus Information</small>
          </div>
        </div>
      </div>
    </header>

    <main class="my-5">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-header bg-white">
                <div class="row">
                  <div class="col-auto">
                    <img src="./../assets/world.png" />
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
                    <span class="badge badge-primary mb-2">TODAY</span>
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

                    <span class="badge badge-primary mb-2">ALL TIME</span>

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

        <div class="row mt-5">
          <div class="col">
            <div class="card">
              <div class="card-header bg-white">
                <div class="row no-gutters">
                  <div class="col-auto">
                    <img :src="selectedCountry.flag" height="26" class="mr-1" />
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
                    <span class="badge badge-primary mb-2">TODAY</span>
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

                    <span class="badge badge-primary mb-2">ALL TIME</span>
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
                          <h5>
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
      </div>
    </main>

    <footer class="my-5 text-black-50 font-percent">
      <hr />
      <div class="container">
        <small>ATTRIBUTIONS:</small><br /><br />
        <a href="https://newsapi.org">newsapi.org</a><br />
        <a href="https://www.flaticon.com">https://www.flaticon.com</a><br />
        <a href="https://github.com/NovelCOVID/API">novelCovid</a>
      </div>
    </footer>
  </div>
</template>

<script>
const covid = require("novelcovid");

export default {
  data: function() {
    return {
      countriesData: null,
      countriesAffected: 0,

      countriesList: [],
      selectedCountry: { name: "South Africa", flag: null, id: 1 },

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
      countryInfoToggle: false
    };
  },

  mounted() {
    (async () => {
      this.countriesData = await covid.getCountry();
      console.log(this.countriesData);

      //World Stats
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

      this.getCountryStats(this.selectedCountry.name);
    })();
  },

  methods: {
    toggleWorldInfo() {
      this.worldInfoToggle = !this.worldInfoToggle;
    },
    toggleCountryInfo() {
      this.countryInfoToggle = !this.countryInfoToggle;
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
    },
    onChangeCountry() {
      this.getCountryStats(this.selectedCountry.name);
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
header {
  line-height: 1;
  height: 70px;
  padding-top: 15px;
  border-bottom: solid 1px #eee;
}
.stat-row {
  margin-bottom: 10px;
  border-bottom: solid 1px #eee;
}
.font-percent {
  font-size: 12px;
}
</style>

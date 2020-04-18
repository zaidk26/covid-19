<template>
    <div style="min-height:400px;">
        <transition name="fade">
            <div id="loading" v-if="loading">Loading...</div>
        </transition>
        <transition name="fade">
            <div class="container-fluid" v-if="!loading">
                <div class="row mt-3">
                    <!-- country data column-->
                    <div class="col-lg-4">
                        <!-- country data -->
                        <div class="p-4 b-12 bg-white con-box">
                            <div class="row">
                                <div class="col">
                                    <h4>Select a Country</h4>
                                </div>
                            </div>

                            <div class="row no-gutters">
                                <div class="col-auto">
                                    <img
                                        :src="selectedCountry.flag"
                                        height="26"
                                        class="mr-2"
                                        :alt="selectedCountry.name"
                                    />
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
                                        >{{ country.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="stat-row mt-4">
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="text-secodary">Cases</span>
                                    </div>
                                    <div class="col text-right">
                                        <h5 class="m-0">
                                            {{
                                            new Intl.NumberFormat().format(
                                            countryCases
                                            )
                                            }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="stat-row">
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="text-danger">Deaths</span>
                                    </div>
                                    <div class="col text-right">
                                        <h5 class="text-danger m-0">
                                            <small class="text-black-50 font-percent">
                                                ({{
                                                (
                                                (countryDeaths /
                                                countryCases) *
                                                100
                                                ).toFixed(2)
                                                }}%)
                                            </small>
                                            {{
                                            new Intl.NumberFormat().format(
                                            countryDeaths
                                            )
                                            }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="stat-row">
                                <div class="row">
                                    <div class="col-auto my-auto">
                                        <span class="text-success">Recovered</span>
                                    </div>
                                    <div class="col text-right">
                                        <h5 class="m-0 text-success">
                                            <small class="text-black-50 font-percent m-0">
                                                ({{
                                                (
                                                (countryRecovered /
                                                countryCases) *
                                                100
                                                ).toFixed(2)
                                                }}%)
                                            </small>
                                            {{
                                            new Intl.NumberFormat().format(
                                            countryRecovered
                                            )
                                            }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="stat-row">
                                <div class="row">
                                    <div class="col-auto my-auto">
                                        <span class>Tests</span>
                                    </div>
                                    <div class="col text-right">
                                        <h5 class="m-0">
                                            <small class="text-black-50 font-percent m-0">
                                                ({{
                                                (
                                                (countryCases /
                                                countryTests) *
                                                100
                                                ).toFixed(2)
                                                }}% positive)
                                            </small>
                                            {{
                                            new Intl.NumberFormat().format(
                                            countryTests
                                            )
                                            }}
                                        </h5>
                                    </div>
                                </div>
                            </div>

                            <div class="row font-percent font-weight-bold mt-3">
                                <div class="col-4"></div>
                                <div class="col-4 text-right">TODAY</div>
                                <div class="col-4 text-right">YESTERDAY</div>
                            </div>

                            <div class="row">
                                <div class="col my-auto">
                                    <div class="stat-row">
                                        <div class="row">
                                            <div class="col-4">
                                                <span class="text-secodary">Cases</span>
                                            </div>
                                            <div class="col-4 text-right">
                                                <h5 class="m-0">
                                                    {{
                                                    new Intl.NumberFormat().format(
                                                    countryCasesToday
                                                    )
                                                    }}
                                                </h5>
                                            </div>
                                            <div class="col-4 text-right">
                                                <h5 class="m-0">
                                                    {{
                                                    new Intl.NumberFormat().format(
                                                    countryCasesYesterday
                                                    )
                                                    }}
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="stat-row">
                                        <div class="row">
                                            <div class="col-4">
                                                <span class="text-danger">Deaths</span>
                                            </div>
                                            <div class="col-4 text-right">
                                                <h5 class="text-danger m-0">
                                                    {{
                                                    new Intl.NumberFormat().format(
                                                    countryDeathsToday
                                                    )
                                                    }}
                                                </h5>
                                            </div>
                                            <div class="col-4 text-right">
                                                <h5 class="text-danger m-0">
                                                    {{
                                                    new Intl.NumberFormat().format(
                                                    countryDeathsYesterday
                                                    )
                                                    }}
                                                </h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="addInfoCountry">
                                        <transition name="fade">
                                            <div v-show="countryInfoToggle">
                                                <div class="stat-row">
                                                    <div class="row">
                                                        <div class="col-auto">
                                                            <span>Active Cases</span>
                                                        </div>
                                                        <div class="col text-right">
                                                            <h5 class="m-0">
                                                                {{
                                                                new Intl.NumberFormat().format(
                                                                countryActive
                                                                )
                                                                }}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="stat-row">
                                                    <div class="row">
                                                        <div class="col-auto">
                                                            <span>Critical Cases</span>
                                                        </div>
                                                        <div class="col text-right">
                                                            <h5 class="m-0">
                                                                {{
                                                                new Intl.NumberFormat().format(
                                                                countryCritical
                                                                )
                                                                }}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="stat-row">
                                                    <div class="row">
                                                        <div class="col-auto">
                                                            <span>First Case</span>
                                                        </div>
                                                        <div class="col text-right">
                                                            <h5 class="m-0">
                                                                {{
                                                                countryFirstCase | date
                                                                }}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="stat-row">
                                                    <div class="row">
                                                        <div class="col-auto">
                                                            <span>First Death</span>
                                                        </div>
                                                        <div class="col text-right">
                                                            <h5 class="m-0">
                                                                {{
                                                                countryFirstDeath | date
                                                                }}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="stat-row">
                                                    <div class="row">
                                                        <div class="col-auto">
                                                            <span>First Recovered</span>
                                                        </div>
                                                        <div class="col text-right">
                                                            <h5 class="m-0">
                                                                {{
                                                                countryFirstRecovered
                                                                | date
                                                                }}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="stat-row">
                                                    <div class="row">
                                                        <div class="col-auto">
                                                            <span>Cases Per Million</span>
                                                        </div>
                                                        <div class="col text-right">
                                                            <h5 class="m-0">
                                                                {{
                                                                new Intl.NumberFormat().format(
                                                                countryCasesPerMil.toFixed(2)
                                                                )
                                                                }}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="stat-row">
                                                    <div class="row">
                                                        <div class="col-auto">
                                                            <span>Tests Per Million</span>
                                                        </div>
                                                        <div class="col text-right">
                                                            <h5 class="m-0">
                                                                {{
                                                                new Intl.NumberFormat().format(
                                                                countryTestsPerMil.toFixed(2)
                                                                )
                                                                }}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="row">
                                                        <div class="col-auto">
                                                            <span>Deaths Per Million</span>
                                                        </div>
                                                        <div class="col text-right">
                                                            <h5 class="m-0">
                                                                {{
                                                                new Intl.NumberFormat().format(
                                                                countryDeathsPerMil.toFixed(2)
                                                                )
                                                                }}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </transition>
                                    </div>

                                    <div id="chartsCountry">
                                        <transition name="fade">
                                            <div v-show="chartsToggle">
                                                <div class="row">
                                                    <div class="col">
                                                        <!-- past 7 days -->
                                                        <line-chart
                                                            class="mt-3"
                                                            :chart-data="past7ChartData"
                                                            :options="past7ChartOptions"
                                                        />

                                                        <hr/>

                                                        <!-- History Graph -->
                                                        <line-chart
                                                            class="mt-2"
                                                            :chart-data="historicalChartData"
                                                            :options="historicalChartOptions"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                        </transition>
                                    </div>

                                    <div id="provincesCountry">
                                        <transition name="fade">
                                            <div v-show="provincesToggle" class="mt-3">
                                                <small class="text-black-50">
                                                    *Data may be out of date
                                                    <a href="https://sacoronavirus.co.za">sacoronavirus.co.za</a>
                                                </small>
                                                <span class="font-percent my-2" v-html="saProvinces"></span>

                                                <!-- <div class="stat-row" v-for="(val,key) in saProvinces" :key="key">
                                                  <div class="row">
                                                      <div class="col-8">
                                                          {{ key.charAt(0).toUpperCase() + key.slice(1) }}
                                                      </div>
                                                      <div class="col-4 text-right font-weight-bold">
                                                          {{ val }}
                                                      </div>
                                                  </div>
                        </div>-->
                                            </div>
                                        </transition>
                                    </div>

                                    <div>
                                        <a
                                            v-show="!countryInfoToggle"
                                            v-on:click="toggleCountryInfo"
                                            class="btn btn-sm btn-light my-1"
                                        >more stats</a>
                                        <a
                                            v-show="!chartsToggle"
                                            v-on:click="toggleCharts"
                                            class="btn btn-sm btn-primary my-1"
                                        >view charts</a>
                                        <a
                                            v-show="!provincesToggle"
                                            v-on:click="toggleProvinces"
                                            class="btn btn-sm btn-warning my-1"
                                            v-if="selectedCountry.name=='South Africa'"
                                        >by province</a>
                                    </div>
                                </div>
                            </div>

                            <div class="font-weight-bold mb-2 mt-4">GLOBAL POSITION</div>

                            <div class="stat-row">
                                <div class="row">
                                    <div class="col-auto">
                                        <span>By #Cases</span>
                                    </div>
                                    <div class="col text-right">
                                        <h5 class="m-0">
                                            {{ countryPosGlobalCases }}
                                            <small class="text-black-50 font-percent">
                                                {{
                                                numberSuffix(
                                                countryPosGlobalCases
                                                )
                                                }}
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                            </div>

                            <div class="stat-row">
                                <div class="row">
                                    <div class="col-auto">
                                        <span>By #Deaths</span>
                                    </div>
                                    <div class="col text-right">
                                        <h5 class="m-0">
                                            {{ countryPosGlobalDeaths }}
                                            <small class="text-black-50 font-percent">
                                                {{
                                                numberSuffix(
                                                countryPosGlobalDeaths
                                                )
                                                }}
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                            </div>

                            <div class="stat-row">
                                <div class="row">
                                    <div class="col-auto">
                                        <span>By Low Mortality Rate</span>
                                    </div>
                                    <div class="col text-right">
                                        <h5 class="m-0">
                                            {{ countryPosGlobalDeathsByRate }}
                                            <small class="text-black-50 font-percent">
                                                {{
                                                numberSuffix(
                                                countryPosGlobalDeathsByRate
                                                )
                                                }}
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span>By #Recoveries</span>
                                    </div>
                                    <div class="col text-right">
                                        <h5 class="m-0">
                                            {{ countryPosGlobalRecoveries }}
                                            <small class="text-black-50 font-percent">
                                                {{
                                                numberSuffix(
                                                countryPosGlobalRecoveries
                                                )
                                                }}
                                            </small>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="b-12 mt-3 text-center bg-white" style="border:solid 3px #FCFDCB; ">
                            <div class="p-3" v-show="customList.length == 0">
                                <h4>Monitor</h4>
                                <small>Want to monitor stats of a few countries? create a custom list</small>
                                <br/>
                                <br/>
                                <button class="btn btn-sm btn-warning" @click="manageCustomList">Create List +</button>
                            </div>

                            <div v-show="customList.length > 0" class="text-left" style="font-size:12px;">
                                <div class="row no-gutters mx-3 mt-4">
                                    <div class="col-auto">
                                        <h6 class="mr-1 mt-1">Sorted By:</h6>
                                    </div>
                                    <div class="col">
                                        <select class="form-control form-control-sm" @change="onChangeSort($event)">
                                            <option selected value="deaths">Most Deaths</option>
                                            <option value="cases">Most Cases</option>
                                            <option value="recovered">Most Recovered</option>
                                            <option value="todayCases">Most Cases Today</option>
                                            <option value="todayDeaths">Most Deaths Today</option>
                                        </select>
                                    </div>
                                </div>

                                <div style="font-size:12px;min-width:100%;" class="bg-light px-1 mt-4">
                                    <div class="float-left" style="width:20%;">Cases</div>
                                    <div class="float-left" style="width:20%;">Deaths</div>
                                    <div class="float-left" style="width:20%;">Recov.</div>
                                    <div class="float-left" style="width:20%;">C. Today</div>
                                    <div class="float-left" style="width:20%;">D. Today</div>
                                </div>

                                <div style="clear:both;"></div>

                                <div v-for="(country,i) in countriesData" :key="country.country">
                                    <div v-if="customList.indexOf(country.country) > -1">
                                        <div
                                            class="py-2 pl-2 pointer border-bottom"
                                            style="font-size:12px; min-width:100%;"
                                            @click="viewCountryStatsOnClick(country.country)"
                                        >
                                            <div>
                                                <div class="row">
                                                    <div class="col-9">
                                                        <h6 class="my-1 text-primary">
                                                            <u>{{ country.country }}</u>
                                                        </h6>
                                                    </div>
                                                    <div class="col-3 text-right">
                                                        <span class="badge badge-primary mr-2">#{{ i + 1 }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="font-weight-bold float-left" style="width:20%;">
                                                {{
                                                new Intl.NumberFormat().format(
                                                country.cases
                                                )
                                                }}
                                            </div>
                                            <div class="font-weight-bold text-danger float-left" style="width:20%;">
                                                {{
                                                new Intl.NumberFormat().format(
                                                country.deaths
                                                )
                                                }}
                                            </div>
                                            <div class="font-weight-bold text-success float-left" style="width:20%;">
                                                {{
                                                new Intl.NumberFormat().format(
                                                country.recovered
                                                )
                                                }}
                                            </div>
                                            <div class="font-weight-bold float-left" style="width:20%;">
                                                {{
                                                new Intl.NumberFormat().format(
                                                country.todayCases
                                                )
                                                }}
                                            </div>
                                            <div class="font-weight-bold text-danger float-left" style="width:20%;">
                                                {{
                                                new Intl.NumberFormat().format(
                                                country.todayDeaths
                                                )
                                                }}
                                            </div>

                                            <div style="clear:both;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mx-1 mb-4 mt-2 text-right" v-if="customList.length > 0">
                                <div class="col-12">
                                    <button class="btn btn-sm btn-warning" @click="manageCustomList">Manage List
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div v-if="selectedCountry.name == 'South Africa'">
                            <div class="p-3 b-12 bg-light mt-3 text-center">
                                <h4 class="mb-0">Lockdown Time Remaining</h4>
                                <div id="timer" class="timer">
                                    <!--  Timer Component  -->
                                    <Timer
                                        starttime="Mar 26, 2020 23:59:59"
                                        endtime="Apr 30, 2020 23:59:59"
                                        :trans="trans"
                                    ></Timer>
                                    <!--  End! Timer Component  -->
                                </div>
                            </div>

                            <div class="p-3 b-12 bg-white mt-3 con-box">
                                <h4 class="mt-3">SA News Headlines</h4>
                                <div
                                    class="stat-row"
                                    v-for="article in newsArticlesSa.slice(0, 5)"
                                    :key="article.id"
                                >
                                    <a :href="article.url">
                                        <div class="media" v-lazy-container="{ selector: 'img' }">
                                            <img
                                                :data-src="article.urlToImage"
                                                class="mr-2"
                                                :alt="article.title"
                                                width="72"
                                            />
                                            <div class="media-body">
                                                {{ article.title }}
                                                <br/>
                                                <small class="text-black-50 font-percentage">- {{ article.source.name
                                                    }}</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="mt-3">
                                    <a
                                        v-show="!newsSaToggle"
                                        v-on:click="toggleNewsSa"
                                        class="btn btn-sm btn-light"
                                    >more articles +</a>
                                </div>
                                <div v-if="newsSaToggle">
                                    <div
                                        class="stat-row"
                                        v-for="article in newsArticlesSa.slice(
                                            5,
                                            15
                                        )"
                                        :key="article.id"
                                    >
                                        <a :href="article.url">
                                            <div
                                                class="media"
                                                v-lazy-container="{
                                                    selector: 'img'
                                                }"
                                            >
                                                <img
                                                    :data-src="article.urlToImage"
                                                    class="mr-2"
                                                    :alt="article.title"
                                                    width="72"
                                                />
                                                <div class="media-body">
                                                    {{ article.title }}
                                                    <br/>
                                                    <small class="text-black-50 font-percentage">- {{
                                                        article.source.name }}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <!-- <div v-if="saCoronaUpdate.title != undefined">
                                    <h4 class="mt-3">{{ saCoronaUpdate.title }}</h4>
                                    <p>
                                        Source:
                                        <a :href="saCoronaUpdate.link"
                                            >sacoronavirus.co.za</a
                                        >
                                    </p>
                                    <br />
                                    <span
                                        v-html="saCoronaUpdate.data.slice(0, 600)"
                                    ></span>.....
                                    <br />
                                    <p>
                                        Read On at:
                                        <a :href="saCoronaUpdate.link"
                                            >sacoronavirus.co.za</a
                                        >
                                    </p>
                </div>-->
                            </div>
                        </div>
                    </div>
                    <!-- /country column -->

                    <!-- world data column-->
                    <div class="col-lg-4 mt-5 mt-lg-0">
                        <!-- world Data -->
                        <div class="p-4 b-12 bg-light">
                            <div class="row">
                                <div class="col-auto">
                                    <img src="/img/world.png" alt="world" height="44"/>
                                </div>
                                <div class="col-auto">
                                    <h4 class="m-0 p-0">The World</h4>
                                    <small class="text-muted m-0 p-0">
                                        {{ countriesAffected }} Countries
                                        affected
                                    </small>
                                </div>
                            </div>

                            <div class="mt-2">
                                <div class="row">
                                    <div class="col my-auto">
                                        <div class="stat-row">
                                            <div class="row">
                                                <div class="col-auto">
                                                    <span class>Cases</span>
                                                </div>
                                                <div class="col text-right">
                                                    <h5 class="m-0">
                                                        {{
                                                        new Intl.NumberFormat().format(
                                                        worldCases
                                                        )
                                                        }}
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="stat-row">
                                            <div class="row">
                                                <div class="col-auto">
                                                    <span class="text-danger">Deaths</span>
                                                </div>
                                                <div class="col text-right">
                                                    <h5 class="text-danger m-0">
                                                        <small class="text-black-50 font-percent">
                                                            ({{
                                                            (
                                                            (worldDeaths /
                                                            worldCases) *
                                                            100
                                                            ).toFixed(2)
                                                            }}%)
                                                        </small>
                                                        {{
                                                        new Intl.NumberFormat().format(
                                                        worldDeaths
                                                        )
                                                        }}
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="stat-row">
                                            <div class="row">
                                                <div class="col-auto my-auto">
                                                    <span class="text-success">Recovered</span>
                                                </div>
                                                <div class="col text-right">
                                                    <h5 class="m-0 text-success">
                                                        <small class="text-black-50 font-percent m-0">
                                                            ({{
                                                            (
                                                            (worldRecovered /
                                                            worldCases) *
                                                            100
                                                            ).toFixed(2)
                                                            }}%)
                                                        </small>
                                                        {{
                                                        new Intl.NumberFormat().format(
                                                        worldRecovered
                                                        )
                                                        }}
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="stat-row">
                                            <div class="row">
                                                <div class="col-auto my-auto">
                                                    <span class>Tests</span>
                                                </div>
                                                <div class="col text-right">
                                                    <h5 class="m-0">
                                                        <small class="text-black-50 font-percent">
                                                            ({{
                                                            (
                                                            (worldCases /
                                                            worldTests) *
                                                            100
                                                            ).toFixed(2)
                                                            }}%)
                                                        </small>
                                                        {{
                                                        new Intl.NumberFormat().format(
                                                        worldTests
                                                        )
                                                        }}
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row font-percent font-weight-bold mt-3">
                                            <div class="col-4"></div>
                                            <div class="col-4 text-right">TODAY</div>
                                            <div class="col-4 text-right">YESTERDAY</div>
                                        </div>
                                        <div class="stat-row">
                                            <div class="row">
                                                <div class="col-4">
                                                    <span class>Cases</span>
                                                </div>
                                                <div class="col-4 text-right">
                                                    <h5 class="m-0">
                                                        {{
                                                        new Intl.NumberFormat().format(
                                                        worldCasesToday
                                                        )
                                                        }}
                                                    </h5>
                                                </div>
                                                <div class="col-4 text-right">
                                                    <h5 class="m-0">
                                                        {{
                                                        new Intl.NumberFormat().format(
                                                        worldCasesYesterday
                                                        )
                                                        }}
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="stat-row">
                                            <div class="row">
                                                <div class="col-4">
                                                    <span class="text-danger">Deaths</span>
                                                </div>
                                                <div class="col-4 text-right">
                                                    <h5 class="text-danger m-0">
                                                        {{
                                                        new Intl.NumberFormat().format(
                                                        worldDeathsToday
                                                        )
                                                        }}
                                                    </h5>
                                                </div>
                                                <div class="col-4 text-right">
                                                    <h5 class="text-danger m-0">
                                                        {{
                                                        new Intl.NumberFormat().format(
                                                        worldDeathsYesterday
                                                        )
                                                        }}
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="addInfoWorld">
                                            <transition name="fade">
                                                <div v-show="worldInfoToggle">
                                                    <div class="stat-row">
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <span>Active Cases</span>
                                                            </div>
                                                            <div class="col text-right">
                                                                <h5 class="m-0">
                                                                    {{
                                                                    new Intl.NumberFormat().format(
                                                                    worldActive
                                                                    )
                                                                    }}
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="stat-row">
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <span>Critical Cases</span>
                                                            </div>
                                                            <div class="col text-right">
                                                                <h5 class="m-0">
                                                                    {{
                                                                    new Intl.NumberFormat().format(
                                                                    worldCritical
                                                                    )
                                                                    }}
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="stat-row">
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <span>Cases Per Million</span>
                                                            </div>
                                                            <div class="col text-right">
                                                                <h5 class="m-0">
                                                                    {{
                                                                    new Intl.NumberFormat().format(
                                                                    worldCasesPerMil.toFixed(0)
                                                                    )
                                                                    }}
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="stat-row">
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <span>Tests Per Million</span>
                                                            </div>
                                                            <div class="col text-right">
                                                                <h5 class="m-0">
                                                                    {{
                                                                    new Intl.NumberFormat().format(
                                                                    worldTestsPerMil.toFixed(0)
                                                                    )
                                                                    }}
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <span>Deaths Per Million</span>
                                                            </div>
                                                            <div class="col text-right">
                                                                <h5 class="m-0">
                                                                    {{
                                                                    new Intl.NumberFormat().format(
                                                                    worldDeathsPerMil.toFixed(0)
                                                                    )
                                                                    }}
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </transition>
                                        </div>

                                        <div id="chartsWorld">
                                            <transition name="fade">
                                                <div v-if="chartsWorldToggle">
                                                    <div class="row">
                                                        <div class="col">
                                                            <!-- past 7 days -->
                                                            <line-chart
                                                                class="mt-3"
                                                                :chart-data="worldPast7ChartData"
                                                                :options="worldPast7ChartOptions"
                                                            />

                                                            <hr/>

                                                            <!-- History Graph -->
                                                            <line-chart
                                                                class="mt-2"
                                                                :chart-data="worldHistoricalChartData"
                                                                :options="worldHistoricalChartOptions"
                                                            />
                                                        </div>
                                                    </div>
                                                </div>
                                            </transition>
                                        </div>

                                        <div class="mt-3">
                                            <a
                                                v-show="!worldInfoToggle"
                                                v-on:click="toggleWorldInfo"
                                                class="btn btn-sm btn-light"
                                            >more stats</a>
                                            <a
                                                v-show="!chartsWorldToggle"
                                                v-on:click="toggleWorldCharts"
                                                class="btn btn-sm btn-primary"
                                            >view charts</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- continents -->
                            <div>
                                <div class="row mt-3">
                                    <div class="col-4"></div>
                                    <div class="col-4 text-right">Cases</div>
                                    <div class="col-4 text-right">Deaths</div>
                                </div>
                                <div
                                    class="stat-row"
                                    v-for="continent in continentsTotals"
                                    :key="continent.continent"
                                >
                                    <div class="row">
                                        <div class="col-4">{{ continent.continent }}</div>
                                        <div class="col-4 text-right  font-weight-bold ">
                                            <small
                                                class="text-black-50 font-percent m-0"
                                            >({{ ((continent.cases / worldCases) *100).toFixed(2)}}%)</small>
                                            {{ new Intl.NumberFormat().format(continent.cases) }}
                                        </div>
                                        <div class="col-4 text-right text-danger  font-weight-bold ">
                                            <small
                                                class="text-black-50 font-percent m-0"
                                            >({{ ((continent.deaths / worldDeaths) *100).toFixed(2)}}%)</small>
                                            {{ new Intl.NumberFormat().format(continent.deaths) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 b-12 bg-white mt-3 con-box">
                            <h4>Compare Statistics</h4>

                            <div class="row">
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
                                        >{{ country.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="row text-center py-1">
                                <div class="col">
                                    <h4>VS</h4>
                                </div>
                            </div>

                            <div class="row no-gutters">
                                <div class="col">
                                    <select
                                        v-model="vsSelectedCountry"
                                        class="form-control form-control-sm"
                                        @change="compareCountries()"
                                    >
                                        <option disabled value>Select a Country</option>
                                        <option
                                            v-for="country in countriesList"
                                            :key="country.id"
                                            :value="country"
                                        >{{ country.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-3 no-gutters" v-if="countriesCompared">
                                <!-- country 1 -->
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col my-auto">
                                            <div class="stat-row" style="height:50px; overflow:hidden;">
                                                <img :src="selectedCountry.flag" height="22"
                                                     :alt="selectedCountry.name"/>
                                                <h6 class="mt-2">{{ selectedCountry.name }}</h6>
                                            </div>

                                            <div class="stat-row">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <span class="text-secodary font-compare">Cases</span>
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="m-0">
                                                            {{
                                                            new Intl.NumberFormat().format(
                                                            countryCases
                                                            )
                                                            }}
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="stat-row">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <span class="text-danger font-compare">Deaths</span>
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="text-danger m-0">
                                                            {{
                                                            new Intl.NumberFormat().format(
                                                            countryDeaths
                                                            )
                                                            }}
                                                            <small
                                                                class="text-black-50 font-percent"
                                                            >
                                                                ({{
                                                                (
                                                                (countryDeaths /
                                                                countryCases) *
                                                                100
                                                                ).toFixed(2)
                                                                }}%)
                                                            </small>
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="stat-row">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <span class="text-success font-compare">Recovered</span>
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="m-0 text-success">
                                                            {{
                                                            new Intl.NumberFormat().format(
                                                            countryRecovered
                                                            )
                                                            }}
                                                            <small
                                                                class="text-black-50 font-percent m-0"
                                                            >
                                                                ({{
                                                                (
                                                                (countryRecovered /
                                                                countryCases) *
                                                                100
                                                                ).toFixed(2)
                                                                }}%)
                                                            </small>
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="stat-row">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <span class="font-compare">Tests</span>
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="m-0">
                                                            {{
                                                            new Intl.NumberFormat().format(
                                                            countryTests
                                                            )
                                                            }}
                                                            <small
                                                                class="text-black-50 font-percent m-0"
                                                            >
                                                                ({{
                                                                (
                                                                (countryCases /
                                                                countryTests) *
                                                                100
                                                                ).toFixed(2)
                                                                }}%)
                                                            </small>
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="stat-row">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <span class="text-secodary font-compare">Cases Today</span>
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="m-0">
                                                            {{
                                                            new Intl.NumberFormat().format(
                                                            countryCasesToday
                                                            )
                                                            }}
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="stat-row">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <span class="text-danger font-compare">Deaths Today</span>
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="text-danger m-0">
                                                            {{
                                                            new Intl.NumberFormat().format(
                                                            countryDeathsToday
                                                            )
                                                            }}
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="stat-row">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span class="font-compare">Active Cases</span>
                                                        </div>
                                                        <div class="col">
                                                            <h5 class="m-0">
                                                                {{
                                                                new Intl.NumberFormat().format(
                                                                countryActive
                                                                )
                                                                }}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="stat-row">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span class="font-compare">Critical Cases</span>
                                                        </div>
                                                        <div class="col">
                                                            <h5 class="m-0">
                                                                {{
                                                                new Intl.NumberFormat().format(
                                                                countryCritical
                                                                )
                                                                }}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="stat-row">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span class="font-compare">Cases Per Million</span>
                                                        </div>
                                                        <div class="col">
                                                            <h5 class="m-0">
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
                                                        <div class="col-12">
                                                            <span class="font-compare">Tests Per Million</span>
                                                        </div>
                                                        <div class="col">
                                                            <h5 class="m-0">
                                                                {{
                                                                new Intl.NumberFormat().format(
                                                                countryTestsPerMil
                                                                )
                                                                }}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="stat-row">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span class="font-compare">Deaths Per Million</span>
                                                        </div>
                                                        <div class="col">
                                                            <h5 class="m-0">
                                                                {{
                                                                new Intl.NumberFormat().format(
                                                                countryDeathsPerMil
                                                                )
                                                                }}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="stat-row">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span class="font-compare">First Case</span>
                                                        </div>
                                                        <div class="col">
                                                            <h5 class="m-0" v-if="countryFirstCase!=''">
                                                                {{
                                                                countryFirstCase
                                                                | date
                                                                }}
                                                            </h5>
                                                            <h5 class="m-0" v-if="countryFirstCase==''">NA</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="stat-row">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span class="font-compare">First Death</span>
                                                        </div>
                                                        <div class="col">
                                                            <h5 class="m-0" v-if="countryDeaths>0">
                                                                {{
                                                                countryFirstDeath
                                                                | date
                                                                }}
                                                            </h5>
                                                            <h5 class="m-0" v-if="countryDeaths==0">NA</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="stat-row">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span class="font-compare">First Recovered</span>
                                                        </div>
                                                        <div class="col">
                                                            <h5 class="m-0" v-if="countryRecovered>0">
                                                                {{
                                                                countryFirstRecovered
                                                                | date
                                                                }}
                                                            </h5>
                                                            <h5 class="m-0" v-if="countryRecovered==0">NA</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="font-weight-bold mb-2 mt-4">GLOBAL POSITION</div>

                                    <div class="stat-row">
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="font-compare">By #Cases</span>
                                            </div>
                                            <div class="col">
                                                <h5 class="m-0">
                                                    {{ countryPosGlobalCases }}
                                                    <small class="text-black-50 font-percent">
                                                        {{
                                                        numberSuffix(
                                                        countryPosGlobalCases
                                                        )
                                                        }}
                                                    </small>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="stat-row">
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="font-compare">By #Deaths</span>
                                            </div>
                                            <div class="col">
                                                <h5 class="m-0">
                                                    {{ countryPosGlobalDeaths }}
                                                    <small class="text-black-50 font-percent">
                                                        {{
                                                        numberSuffix(
                                                        countryPosGlobalDeaths
                                                        )
                                                        }}
                                                    </small>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="font-compare">By #Recoveries</span>
                                            </div>
                                            <div class="col">
                                                <h5 class="m-0">
                                                    {{ countryPosGlobalRecoveries }}
                                                    <small class="text-black-50 font-percent">
                                                        {{
                                                        numberSuffix(
                                                        countryPosGlobalRecoveries
                                                        )
                                                        }}
                                                    </small>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- country 2 -->
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col my-auto">
                                            <div class="stat-row" style="height:50px; overflow:hidden;">
                                                <img
                                                    :src="vsSelectedCountry.flag"
                                                    height="22"
                                                    :alt="vsSelectedCountry.name"
                                                />
                                                <h6 class="mt-2">{{ vsSelectedCountry.name }}</h6>
                                            </div>

                                            <div class="stat-row">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <span class="text-white font-compare">Cases</span>
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="m-0">
                                                            {{
                                                            new Intl.NumberFormat().format(
                                                            vsCountryCases
                                                            )
                                                            }}
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="stat-row">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <span class="text-white font-compare">Deaths</span>
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="text-danger m-0">
                                                            {{
                                                            new Intl.NumberFormat().format(
                                                            vsCountryDeaths
                                                            )
                                                            }}
                                                            <small
                                                                class="text-black-50 font-percent"
                                                            >
                                                                ({{
                                                                (
                                                                (vsCountryDeaths /
                                                                vsCountryCases) *
                                                                100
                                                                ).toFixed(2)
                                                                }}%)
                                                            </small>
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="stat-row">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <span class="text-white font-compare">Recovered</span>
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="m-0 text-success">
                                                            {{
                                                            new Intl.NumberFormat().format(
                                                            vsCountryRecovered
                                                            )
                                                            }}
                                                            <small
                                                                class="text-black-50 font-percent m-0"
                                                            >
                                                                ({{
                                                                (
                                                                (vsCountryRecovered /
                                                                vsCountryCases) *
                                                                100
                                                                ).toFixed(2)
                                                                }}%)
                                                            </small>
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="stat-row">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <span class="text-white font-compare">Tests</span>
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="m-0">
                                                            {{
                                                            new Intl.NumberFormat().format(
                                                            vsCountryTests
                                                            )
                                                            }}
                                                            <small
                                                                class="text-black-50 font-percent m-0"
                                                            >
                                                                ({{
                                                                (
                                                                (vsCountryCases /
                                                                vsCountryTests) *
                                                                100
                                                                ).toFixed(2)
                                                                }}%)
                                                            </small>
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="stat-row">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <span class="text-white font-compare">Cases Today</span>
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="m-0">
                                                            {{
                                                            new Intl.NumberFormat().format(
                                                            vsCountryCasesToday
                                                            )
                                                            }}
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="stat-row">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <span class="text-white font-compare">Deaths Today</span>
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="text-danger m-0">
                                                            {{
                                                            new Intl.NumberFormat().format(
                                                            vsCountryDeathsToday
                                                            )
                                                            }}
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="stat-row">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span class="font-compare text-white">Active Cases</span>
                                                        </div>
                                                        <div class="col">
                                                            <h5 class="m-0">
                                                                {{
                                                                new Intl.NumberFormat().format(
                                                                vsCountryActive
                                                                )
                                                                }}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="stat-row">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span class="font-compare text-white">Critical Cases</span>
                                                        </div>
                                                        <div class="col">
                                                            <h5 class="m-0">
                                                                {{
                                                                new Intl.NumberFormat().format(
                                                                vsCountryCritical
                                                                )
                                                                }}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="stat-row">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span
                                                                class="font-compare text-white">Cases Per Million</span>
                                                        </div>
                                                        <div class="col">
                                                            <h5 class="m-0">
                                                                {{
                                                                new Intl.NumberFormat().format(
                                                                vsCountryCasesPerMil
                                                                )
                                                                }}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="stat-row">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span
                                                                class="font-compare text-white">Tests Per Million</span>
                                                        </div>
                                                        <div class="col">
                                                            <h5 class="m-0">
                                                                {{
                                                                new Intl.NumberFormat().format(
                                                                vsCountryTestsPerMil
                                                                )
                                                                }}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="stat-row">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span
                                                                class="font-compare text-white">Deaths Per Million</span>
                                                        </div>
                                                        <div class="col">
                                                            <h5 class="m-0">
                                                                {{
                                                                new Intl.NumberFormat().format(
                                                                vsCountryDeathsPerMil
                                                                )
                                                                }}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="stat-row">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span class="font-compare text-white">First Case</span>
                                                        </div>
                                                        <div class="col">
                                                            <h5 class="m-0" v-if="vsCountryFirstCase.length!=''">
                                                                {{
                                                                vsCountryFirstCase | date
                                                                }}
                                                            </h5>
                                                            <h5 class="m-0" v-if="vsCountryFirstCase==''">NA</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="stat-row">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span class="font-compare text-white">First Death</span>
                                                        </div>
                                                        <div class="col">
                                                            <h5 class="m-0" v-if="vsCountryDeaths>0">
                                                                {{
                                                                vsCountryFirstDeath
                                                                | date
                                                                }}
                                                            </h5>
                                                            <h5 class="m-0" v-if="vsCountryDeaths==0">NA</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="stat-row">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span class="font-compare text-white">First Recovered</span>
                                                        </div>
                                                        <div class="col">
                                                            <h5 class="m-0" v-if="vsCountryRecovered>0">
                                                                {{
                                                                vsCountryFirstRecovered
                                                                | date
                                                                }}
                                                            </h5>
                                                            <h5 class="m-0" v-if="vsCountryRecovered==0">NA</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="font-weight-bold mb-2 mt-4 text-white">GLOBAL POSITION</div>

                                    <div class="stat-row">
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="font-compare text-white">By Cases</span>
                                            </div>
                                            <div class="col">
                                                <h5 class="m-0">
                                                    {{ vsCountryPosGlobalCases }}
                                                    <small class="text-black-50 font-percent">
                                                        {{
                                                        numberSuffix(
                                                        vsCountryPosGlobalCases
                                                        )
                                                        }}
                                                    </small>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="stat-row">
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="font-compare text-white">By Deaths</span>
                                            </div>
                                            <div class="col">
                                                <h5 class="m-0">
                                                    {{ vsCountryPosGlobalDeaths }}
                                                    <small class="text-black-50 font-percent">
                                                        {{
                                                        numberSuffix(
                                                        vsCountryPosGlobalDeaths
                                                        )
                                                        }}
                                                    </small>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="font-compare text-white">By Recoveries</span>
                                            </div>
                                            <div class="col">
                                                <h5 class="m-0">
                                                    {{
                                                    vsCountryPosGlobalRecoveries
                                                    }}
                                                    <small
                                                        class="text-black-50 font-percent"
                                                    >
                                                        {{
                                                        numberSuffix(
                                                        vsCountryPosGlobalRecoveries
                                                        )
                                                        }}
                                                    </small>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div v-if="vsSelectedCountry != ''">
                                <!-- past 7 days -->
                                <line-chart
                                    class="mt-3"
                                    :chart-data="vsPast7ChartData"
                                    :options="vsPast7ChartOptions"
                                />

                                <hr/>

                                <!-- History Graph -->
                                <line-chart
                                    class="mt-2"
                                    :chart-data="vsHistoricalChartData"
                                    :options="vsHistoricalChartOptions"
                                />
                            </div>
                        </div>

                        <div class="p-3 b-12 bg-white mt-3 con-box">
                            <h4 class="mt-3">World News Headlines</h4>
                            <div>
                                <div
                                    class="stat-row"
                                    v-for="article in newsArticlesWorld.slice(0, 5)"
                                    :key="article.id"
                                >
                                    <a :href="article.url">
                                        <div class="media" v-lazy-container="{ selector: 'img' }">
                                            <img
                                                :data-src="article.urlToImage"
                                                class="mr-2"
                                                :alt="article.title"
                                                width="72"
                                            />
                                            <div class="media-body">
                                                {{ article.title }}
                                                <br/>
                                                <small class="text-black-50 font-percentage">- {{ article.source.name
                                                    }}</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="mt-3">
                                    <a
                                        v-show="!newsWorldToggle"
                                        v-on:click="toggleNewsWorld"
                                        class="btn btn-sm btn-light"
                                    >more articles +</a>
                                </div>
                                <div v-if="newsWorldToggle">
                                    <div
                                        class="stat-row"
                                        v-for="article in newsArticlesWorld.slice(
                                            5,
                                            15
                                        )"
                                        :key="article.id"
                                    >
                                        <a :href="article.url">
                                            <div
                                                class="media"
                                                v-lazy-container="{
                                                    selector: 'img'
                                                }"
                                            >
                                                <img
                                                    :data-src="article.urlToImage"
                                                    class="mr-2"
                                                    :alt="article.title"
                                                    width="72"
                                                />
                                                <div class="media-body">
                                                    {{ article.title }}
                                                    <br/>
                                                    <small class="text-black-50 font-percentage">- {{
                                                        article.source.name }}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /world data column -->
                    <!-- Top 10 data column-->
                    <div class="col-lg-4">
                        <div class="mt-5 mt-lg-0 b-12 bg-white con-box">
                            <div class="p-4">
                                <div class="pb-1">
                                    <h4>
                                        Top
                                        <select
                                            v-model="topDropDownInt"
                                            @change="getData(sortBy)"
                                            class="form-control form-control-sm"
                                            style="width:60px;display:inline;"
                                        >
                                            <option>{{ topDropDownInt }}</option>
                                            <option>5</option>
                                            <option>10</option>
                                            <option>25</option>
                                            <option>50</option>
                                            <option>100</option>
                                        </select>
                                        Countries
                                    </h4>
                                    <div class="row no-gutters">
                                        <div class="col-auto">
                                            <h6 class="mr-1 mt-1">Sorted By:</h6>
                                        </div>
                                        <div class="col">
                                            <select class="form-control form-control-sm" @change="onChangeSort($event)">
                                                <option selected value="deaths">Most Deaths</option>
                                                <option value="cases">Most Cases</option>
                                                <option value="recovered">Most Recovered</option>
                                                <option value="todayCases">Most Cases Today</option>
                                                <option value="todayDeaths">Most Deaths Today</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <br/>

                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="exampleRadios1">
                                        <h6>View As</h6>
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" v-model="topViewStyle" value="table"/>
                                    <label class="form-check-label" for="exampleRadios1">Table</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" v-model="topViewStyle" value="boxes"/>
                                    <label class="form-check-label" for="exampleRadios2">Detailed</label>
                                </div>
                            </div>

                            <!-- table -->
                            <div v-if="topViewStyle == 'table'" style="font-size:12px;">
                                <div style="font-size:12px;min-width:100%;" class="bg-light px-1">
                                    <div class="float-left" style="width:20%;">Cases</div>
                                    <div class="float-left" style="width:20%;">Deaths</div>
                                    <div class="float-left" style="width:20%;">Recov.</div>
                                    <div class="float-left" style="width:20%;">C. Today</div>
                                    <div class="float-left" style="width:20%;">D. Today</div>
                                </div>

                                <div style="clear:both;"></div>

                                <div
                                    v-for="(country, i) in countriesData.slice(
                                        0,
                                        topDropDownInt
                                    )"
                                    :key="country.country"
                                    :class="{ 'bg-light': i % 2 == 0 }"
                                    class="py-2 pl-2 pointer"
                                    style="font-size:12px; min-width:100%;"
                                    @click="
                                        viewCountryStatsOnClick(country.country)
                                    "
                                >
                                    <div>
                                        <div class="row">
                                            <div class="col-9">
                                                <h6 class="my-1 text-primary">
                                                    <u>{{ country.country }}</u>
                                                </h6>
                                            </div>
                                            <div class="col-3 text-right">
                                                <span class="badge badge-primary mr-2">#{{ i + 1 }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="font-weight-bold float-left" style="width:20%;">
                                        {{
                                        new Intl.NumberFormat().format(
                                        country.cases
                                        )
                                        }}
                                    </div>
                                    <div class="font-weight-bold text-danger float-left" style="width:20%;">
                                        {{
                                        new Intl.NumberFormat().format(
                                        country.deaths
                                        )
                                        }}
                                    </div>
                                    <div class="font-weight-bold text-success float-left" style="width:20%;">
                                        {{
                                        new Intl.NumberFormat().format(
                                        country.recovered
                                        )
                                        }}
                                    </div>
                                    <div class="font-weight-bold float-left" style="width:20%;">
                                        {{
                                        new Intl.NumberFormat().format(
                                        country.todayCases
                                        )
                                        }}
                                    </div>
                                    <div class="font-weight-bold text-danger float-left" style="width:20%;">
                                        {{
                                        new Intl.NumberFormat().format(
                                        country.todayDeaths
                                        )
                                        }}
                                    </div>

                                    <div style="clear:both;"></div>
                                </div>
                            </div>

                            <!-- top boxes -->
                            <div v-if="topViewStyle == 'boxes'">
                                <div
                                    class="border b-12 p-3 mb-3 mt-3"
                                    v-for="(country, i) in countriesData.slice(
                                        0,
                                        topDropDownInt
                                    )"
                                    :key="country.country"
                                >
                                    <div
                                        class="row my-2 pointer"
                                        @click="
                                            viewCountryStatsOnClick(country.country)
                                        "
                                    >
                                        <div class="col-3">
                                            <img :src="country.countryInfo.flag" class="img-fluid"
                                                 :alt="country.country"/>
                                        </div>
                                        <div class="col-7">
                                            <h4><u>{{ country.country }}</u></h4>
                                        </div>
                                        <div class="col-2">
                                            <span class="badge badge-primary">#{{ i + 1 }}</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col my-auto">
                                            <div class="stat-row">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span class>Cases</span>
                                                    </div>
                                                    <div class="col text-right">
                                                        <h5 class="m-0">
                                                            {{
                                                            new Intl.NumberFormat().format(
                                                            country.cases
                                                            )
                                                            }}
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="stat-row">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span class="text-danger">Deaths</span>
                                                    </div>
                                                    <div class="col text-right">
                                                        <h5 class="text-danger m-0">
                                                            <small class="text-black-50 font-percent">
                                                                ({{
                                                                (
                                                                (country.deaths /
                                                                country.cases) *
                                                                100
                                                                ).toFixed(2)
                                                                }}%)
                                                            </small>
                                                            {{
                                                            new Intl.NumberFormat().format(
                                                            country.deaths
                                                            )
                                                            }}
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="stat-row">
                                                <div class="row">
                                                    <div class="col-auto my-auto">
                                                        <span class="text-success">Recovered</span>
                                                    </div>
                                                    <div class="col text-right">
                                                        <h5 class="m-0 text-success">
                                                            <small class="text-black-50 font-percent m-0">
                                                                ({{
                                                                (
                                                                (country.recovered /
                                                                country.cases) *
                                                                100
                                                                ).toFixed(2)
                                                                }}%)
                                                            </small>
                                                            {{
                                                            new Intl.NumberFormat().format(
                                                            country.recovered
                                                            )
                                                            }}
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="stat-row">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span>Cases Today</span>
                                                    </div>
                                                    <div class="col text-right">
                                                        <h5 class="m-0">
                                                            {{
                                                            new Intl.NumberFormat().format(
                                                            country.todayCases
                                                            )
                                                            }}
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="stat-row">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span class="text-danger">Deaths Today</span>
                                                    </div>
                                                    <div class="col text-right">
                                                        <h5 class="text-danger m-0">
                                                            <small
                                                                class="text-black-50 font-percent"
                                                                v-show="
                                                                    country.todayCases >
                                                                        0
                                                                "
                                                            >
                                                                ({{
                                                                (
                                                                (country.todayDeaths /
                                                                country.todayCases) *
                                                                100
                                                                ).toFixed(2)
                                                                }}%)
                                                            </small>
                                                            {{
                                                            new Intl.NumberFormat().format(
                                                            country.todayDeaths
                                                            )
                                                            }}
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="stat-row">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span>Tests</span>
                                                    </div>
                                                    <div class="col text-right">
                                                        <h5 class="m-0">
                                                            <small
                                                                class="text-black-50 font-percent"
                                                                
                                                            >
                                                                ({{
                                                                (
                                                                (country.cases /
                                                                country.tests) *
                                                                100
                                                                ).toFixed(2)
                                                                }}%)
                                                            </small>
                                                            {{
                                                            new Intl.NumberFormat().format(
                                                            country.tests
                                                            )
                                                            }}
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="stat-row">
                                                    <div class="row">
                                                        <div class="col-auto">
                                                            <span>Active Cases</span>
                                                        </div>
                                                        <div class="col text-right">
                                                            <h5 class="m-0">
                                                                {{
                                                                new Intl.NumberFormat().format(
                                                                country.active
                                                                )
                                                                }}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="stat-row">
                                                    <div class="row">
                                                        <div class="col-auto">
                                                            <span>Critical Cases</span>
                                                        </div>
                                                        <div class="col text-right">
                                                            <h5 class="m-0">
                                                                {{
                                                                new Intl.NumberFormat().format(
                                                                country.critical
                                                                )
                                                                }}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="stat-row">
                                                    <div class="row">
                                                        <div class="col-auto">
                                                            <span>Cases Per Million</span>
                                                        </div>
                                                        <div class="col text-right">
                                                            <h5 class="m-0">
                                                                {{
                                                                new Intl.NumberFormat().format(
                                                                country.casesPerOneMillion
                                                                )
                                                                }}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="row">
                                                        <div class="col-auto">
                                                            <span>Deaths Per Million</span>
                                                        </div>
                                                        <div class="col text-right">
                                                            <h5 class="m-0">
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

                        <div class="mt-3 p-3 b-12 bg-white con-box">
                            <div class="pb-1">
                                <h4>
                                    Top
                                    <select
                                        v-model="topDropDownInt"
                                        @change="getData(sortBy)"
                                        class="form-control form-control-sm"
                                        style="width:60px;display:inline;"
                                    >
                                        <option>{{ topDropDownInt }}</option>
                                        <option>5</option>
                                        <option>10</option>
                                        <option>25</option>
                                    </select>
                                    Countries
                                </h4>
                                <div class="row no-gutters">
                                    <div class="col-auto">
                                        <h6 class="mr-1 mt-1">Sorted By:</h6>
                                    </div>
                                    <div class="col">
                                        <select class="form-control form-control-sm" @change="onChangeSort($event)">
                                            <option selected value="deaths">Most Deaths</option>
                                            <option value="cases">Most Cases</option>
                                            <option value="recovered">Most Recovered</option>
                                            <option value="todayCases">Most Cases Today</option>
                                            <option value="todayDeaths">Most Deaths Today</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <radar-chart class="mb-3 mt-2" :chart-data="topChartData" :options="topChartOptions"/>
                        </div>
                    </div>
                    <!-- /end top 10 data col -->
                </div>
                <!-- /row  -->
            </div>
        </transition>
        <!-- /container  -->

        <!-- Modal custom list manage -->
        <transition name="fade">
            <div id="overlay" :class="{'d-block':showManageModal}"></div>
        </transition>
        <transition name="fade">
            <div
                class="modal fade"
                tabindex="-1"
                role="dialog"
                :class="{'d-block':showManageModal,'show':showManageModal}"
            >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title">Manage Custom Countries List</h6>
                            <button
                                type="button"
                                class="close"
                                data-dismiss="modal"
                                aria-label="Close"
                                @click="closeCustomModal()"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="height:280px; overflow-y:scroll;">
                            <p>Select the countries you would like to add to you custom list.</p>
                            <div class="form-check" v-for="country in countriesList" :key="country.name">
                                <input
                                    type="checkbox"
                                    :value="country.name"
                                    v-model="customList"
                                    class="form-check-input form-check-input-lg"
                                />
                                <label class="form-check-label">{{country.name}}</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" @click="closeCustomModal()">Save changes
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </transition>

        <!-- Updated -->
        <div class="container-fluid my-5 text-center" v-if="!loading">
            <div class="row">
                <div class="col-12">
                    <div class="b-12 p-1 bg-light">
                        <p class="text-black-50 font-percent m-0">Updated At</p>
                        <p class="m-0 text-body">
                            <strong>{{ updatedAt }}</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import LineChart from "./LineChartComponent";
    import RadarChart from "./RadarChartComponent";
    import Timer from "./CountdownTimer";
    import continents from "./../continents";

    export default {
        components: {LineChart, RadarChart, Timer},
        props: [
            "newsSa",
            "newsWorld",
            "historicalData",
            "saCoronaUpdate",
            "saProvinces"
        ],

        data: function () {
            return {
                updatedAt: "",
                loading: true,

                worldHistoricalChartData: null,
                worldHistoricalChartOptions: {
                    responsive: true,
                    legend: {
                        labels: {
                            usePointStyle: true
                        }
                    },
                    title: {
                        display: true,
                        text: "2020 Historical Data"
                    },
                    tooltips: {
                        mode: "index",
                        intersect: false
                    },
                    hover: {
                        mode: "nearest",
                        intersect: true
                    },
                    scales: {
                        xAxes: [
                            {
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: "Day"
                                }
                            }
                        ],
                        yAxes: [
                            {
                                display: true,
                                scaleLabel: {
                                    display: false,
                                    labelString: "Value"
                                }
                            }
                        ]
                    }
                },

                worldPast7ChartData: null,
                worldPast7ChartOptions: {
                    responsive: true,
                    legend: {
                        labels: {
                            usePointStyle: true
                        }
                    },
                    title: {
                        display: true,
                        text: "Past 7 Days Exc Today"
                    },
                    tooltips: {
                        mode: "index",
                        intersect: false
                    },
                    hover: {
                        mode: "nearest",
                        intersect: true
                    },
                    scales: {
                        xAxes: [
                            {
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: "Day"
                                }
                            }
                        ],
                        yAxes: [
                            {
                                display: true,
                                scaleLabel: {
                                    display: false,
                                    labelString: "Value"
                                }
                            }
                        ]
                    }
                },

                historicalChartData: null,
                historicalChartOptions: {
                    responsive: true,
                    legend: {
                        labels: {
                            usePointStyle: true
                        }
                    },
                    title: {
                        display: true,
                        text: "2020 Historical Data"
                    },
                    tooltips: {
                        mode: "index",
                        intersect: false
                    },
                    hover: {
                        mode: "nearest",
                        intersect: true
                    },
                    scales: {
                        xAxes: [
                            {
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: "Day"
                                }
                            }
                        ],
                        yAxes: [
                            {
                                display: true,
                                scaleLabel: {
                                    display: false,
                                    labelString: "Value"
                                }
                            }
                        ]
                    }
                },

                past7ChartData: null,
                past7ChartOptions: {
                    responsive: true,
                    legend: {
                        labels: {
                            usePointStyle: true
                        }
                    },
                    title: {
                        display: true,
                        text: "Past 7 Days Exc Today"
                    },
                    tooltips: {
                        mode: "index",
                        intersect: false
                    },
                    hover: {
                        mode: "nearest",
                        intersect: true
                    },
                    scales: {
                        xAxes: [
                            {
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: "Day"
                                }
                            }
                        ],
                        yAxes: [
                            {
                                display: true,
                                scaleLabel: {
                                    display: false,
                                    labelString: "Value"
                                }
                            }
                        ]
                    }
                },

                vsHistoricalChartData: null,
                vsHistoricalChartOptions: {
                    responsive: true,
                    legend: {
                        labels: {
                            usePointStyle: true
                        }
                    },
                    title: {
                        display: true,
                        text: "2020 Historical Data"
                    },
                    tooltips: {
                        mode: "index",
                        intersect: false
                    },
                    hover: {
                        mode: "nearest",
                        intersect: true
                    },
                    scales: {
                        xAxes: [
                            {
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: "Day"
                                }
                            }
                        ],
                        yAxes: [
                            {
                                display: true,
                                scaleLabel: {
                                    display: false,
                                    labelString: "Value"
                                }
                            }
                        ]
                    }
                },

                vsPast7ChartData: null,
                vsPast7ChartOptions: {
                    responsive: true,
                    legend: {
                        labels: {
                            usePointStyle: true
                        }
                    },
                    title: {
                        display: true,
                        text: "Past 7 Days Exc Today"
                    },
                    tooltips: {
                        mode: "index",
                        intersect: false
                    },
                    hover: {
                        mode: "nearest",
                        intersect: true
                    },
                    scales: {
                        xAxes: [
                            {
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: "Day"
                                }
                            }
                        ],
                        yAxes: [
                            {
                                display: true,
                                scaleLabel: {
                                    display: false,
                                    labelString: "Value"
                                }
                            }
                        ]
                    }
                },

                topChartData: null,
                topChartOptions: {
                    responsive: true,
                    legend: {
                        position: "top"
                    },
                    scale: {
                        ticks: {
                            beginAtZero: true
                        }
                    }
                },

                countriesData: [],
                countriesDataYesterday: [],
                countriesAffected: 0,

                countriesList: [],
                selectedCountry: {},

                vsSelectedCountry: "",

                newsArticlesSa: [],
                newsArticlesWorld: [],

                trans: `{
        "day":"Day",
        "hours":"Hours",
        "minutes":"Minuts",
        "seconds":"Seconds",
        "expired":"Lockdown Over.",
        "running":"Till the end of lockdown.",
        "upcoming":"Till start of lockdown.",
        "status": {
            "expired":"Expired",
            "running":"Running",
            "upcoming":"Future"
        }}
      `,


                worldData: {},
                worldDataYesterday: {},

                continentsTotals: [
                    {continent: "Africa", deaths: 0, cases: 0, recovered: 0},
                    {continent: "Antarctica", deaths: 0, cases: 0, recovered: 0},
                    {continent: "Asia", deaths: 0, cases: 0, recovered: 0},
                    {continent: "Europe", deaths: 0, cases: 0, recovered: 0},
                    {continent: "North America", deaths: 0, cases: 0, recovered: 0},
                    {continent: "Oceania", deaths: 0, cases: 0, recovered: 0},
                    {continent: "South America", deaths: 0, cases: 0, recovered: 0},
                    {continent: "Ships/Other", deaths: 0, cases: 0, recovered: 0}
                ],

                worldCases: 0,
                worldDeaths: 0,
                worldCasesToday: 0,
                worldDeathsToday: 0,
                worldCasesYesterday: 0,
                worldDeathsYesterday: 0,
                worldActive: 0,
                worldCritical: 0,
                worldRecovered: 0,
                worldCasesPerMil: 0,
                worldDeathsPerMil: 0,
                worldTests: 0,
                worldTestsPerMil: 0,

                countryCases: 0,
                countryDeaths: 0,
                countryCasesToday: 0,
                countryDeathsToday: 0,
                countryCasesYesterday: 0,
                countryDeathsYesterday: 0,
                countryActive: 0,
                countryCritical: 0,
                countryRecovered: 0,
                countryCasesPerMil: 0,
                countryDeathsPerMil: 0,
                countryPosGlobalDeaths: 0,
                countryPosGlobalDeathsByRate: 0,
                countryPosGlobalCases: 0,
                countryPosGlobalRecoveries: 0,
                countryFirstCase: "",
                countryFirstDeath: "",
                countryFirstRecovered: "",
                countryTests: 0,
                countryTestPerMil: 0,

                vsCountryCases: 0,
                vsCountryDeaths: 0,
                vsCountryCasesToday: 0,
                vsCountryDeathsToday: 0,
                vsCountryActive: 0,
                vsCountryCritical: 0,
                vsCountryRecovered: 0,
                vsCountryCasesPerMil: 0,
                vsCountryDeathsPerMil: 0,
                vsCountryPosGlobalDeaths: 0,
                vsCountryPosGlobalDeathsByRate: 0,
                vsCountryPosGlobalCases: 0,
                vsCountryPosGlobalRecoveries: 0,
                vsCountryFirstCase: "",
                vsCountryFirstDeath: "",
                vsCountryFirstRecovered: "",
                vsCountryTests: 0,
                vsCountryTestsPerMil: 0,

                worldInfoToggle: false,
                countryInfoToggle: false,
                topInfoToggle: false,
                newsSaToggle: false,
                newsWorldToggle: false,
                addStatsToggle: false,
                chartsToggle: false,
                chartsWorldToggle: false,
                provincesToggle: false,
                countriesCompared: false,
                showManageModal: false,

                topDropDownInt: 10,
                topViewStyle: "table",

                sortBy: "deaths",

                customList: []
            };
        },

        mounted() {
            if (localStorage.customList) {
                this.customList = JSON.parse(localStorage.customList);
            }
            this.getData(this.sortBy);
            setInterval(
                function () {
                    this.getData(this.sortBy);
                }.bind(this),
                60000
            );
            setTimeout(function () {
                window.location.href = "/";
            }, 6000000);
        },

        filters: {
            date: function (value) {
                var r = value.split("/");
                var m = "";

                switch (parseInt(r[0])) {
                    case 1:
                        m = "Jan";
                        break;
                    case 2:
                        m = "Feb";
                        break;
                    case 3:
                        m = "Mar";
                        break;
                    case 4:
                        m = "Apr";
                        break;
                    case 5:
                        m = "May";
                        break;
                    case 6:
                        m = "Jun";
                        break;
                    case 7:
                        m = "Jul";
                        break;
                    case 8:
                        m = "Aug";
                        break;
                    case 9:
                        m = "Sep";
                        break;
                    case 10:
                        m = "Oct";
                        break;
                    case 11:
                        m = "Nov";
                        break;
                    case 12:
                        m = "Dec";
                        break;
                }
                return r[1] + "-" + m + "-" + r[2];
            }
        },

        methods: {
            getData(sort) {
                axios
                .get("https://corona.lmao.ninja/v2/countries?yesterday=false")
                .then(response => {

                    switch(sort) {
                    case 'deaths':
                        this.countriesData = response.data.sort(this.sortByDeaths);  
                        break;
                    case 'cases':
                        this.countriesData = response.data.sort(this.sortByCases);  
                        break;
                    case 'recovered':
                        this.countriesData = response.data.sort(this.sortByRecovered);  
                        break;
                    case 'todayCases':
                       this.countriesData = response.data.sort(this.sortByCasesToday);  
                        break;
                    case 'todayDeaths':
                        this.countriesData = response.data.sort(this.sortByDeathsToday);  
                        break;
                   
                    }
                                            
                    

                    this.worldCases = 0;
                    this.worldDeaths = 0;
                    this.worldCasesToday = 0;
                    this.worldDeathsToday = 0;
                    this.worldCasesYesterday = 0;
                    this.worldDeathsYesterday = 0;
                    this.worldActive = 0;
                    this.worldCritical = 0;
                    this.worldRecovered = 0;
                    this.worldCasesPerMil = 0;
                    this.worldDeathsPerMil = 0;
                    this.worldTests = 0;
                    this.worldTestsPerMil = 0;
                    this.continentsTotals = [
                        {continent: "Africa", deaths: 0, cases: 0, recovered: 0},
                        {continent: "Antarctica", deaths: 0, cases: 0, recovered: 0},
                        {continent: "Asia", deaths: 0, cases: 0, recovered: 0},
                        {continent: "Europe", deaths: 0, cases: 0, recovered: 0},
                        {continent: "Oceania", deaths: 0, cases: 0, recovered: 0},
                        {continent: "North America", deaths: 0, cases: 0, recovered: 0},
                        {continent: "South America", deaths: 0, cases: 0, recovered: 0},
                        {continent: "Ships/Other", deaths: 0, cases: 0, recovered: 0}
                    ];                    

                    this.countriesList = [];
                    this.countriesAffected = this.countriesData.length;

                    this.countriesData.forEach(element => {
                        //remove world if its in array
                        if (element.country.toLowerCase == "world") {
                            this.worldData = this.countriesData.shift();
                        } else {
                            this.countriesList.push({
                                name: element.country,
                                flag: element.countryInfo.flag,
                                id: element.countryInfo._id,
                                deaths: element.deaths,
                                cases: element.cases,
                                recovered: element.recovered
                            });
                        }
                        let f = false;
                        continents.forEach(con => {
                            if (con.Two_Letter_Country_Code == element.countryInfo.iso2) {
                                this.continentsTotals.forEach(ct => {
                                    if (
                                        ct.continent.toLowerCase() == con.Continent_Name.toLowerCase()
                                    ) {
                                        f = true;
                                        ct.deaths += element.deaths;
                                        ct.cases += element.cases;
                                        ct.recovered += element.recovered;
                                    }
                                });
                            }
                        });
                        if (!f) {
                            this.continentsTotals[7].deaths += element.deaths;
                            this.continentsTotals[7].cases += element.cases;
                            this.continentsTotals[7].recovered += element.recovered;
                        }

                        this.worldCases += element.cases;
                        this.worldDeaths += element.deaths;
                        this.worldCasesToday += element.todayCases;
                        this.worldDeathsToday += element.todayDeaths;
                        this.worldActive += element.active;
                        this.worldCritical += element.critical;
                        this.worldRecovered += element.recovered;
                        this.worldCasesPerMil +=
                            element.casesPerOneMillion / this.countriesData.length;
                        this.worldDeathsPerMil +=
                            element.deathsPerOneMillion / this.countriesData.length;
                        this.worldTests += element.tests;
                        this.worldTestsPerMil +=
                            element.testsPerOneMillion / this.countriesData.length;
                    });

                    //get yesterdays total for world
                    axios
                        .get("https://corona.lmao.ninja/v2/countries?yesterday=true")
                        .then(response => {
                            this.countriesDataYesterday = response.data;

                            this.countriesDataYesterday.forEach(element => {
                                if (element.country.toLowerCase == "world") {
                                    this.worldDataYesterday = this.countriesDataYesterday.shift();
                                }
                                this.worldCasesYesterday += element.todayCases;
                                this.worldDeathsYesterday += element.todayDeaths;
                            });

                            //get country data
                            let c = this.$cookie.get("country");
                            if (c != undefined && c != null) {
                                this.countriesData.forEach(element => {
                                    if (element.country.toLowerCase() == c.toLowerCase()) {
                                        this.selectedCountry.name = c;
                                        this.selectedCountry.flag = element.countryInfo.flag;
                                        this.selectedCountry.id = element.countryInfo._id;
                                        this.selectedCountry.cases = element.cases;
                                        this.selectedCountry.deaths = element.deaths;
                                        this.selectedCountry.recovered = element.recovered;
                                    }
                                });
                                this.getCountryStats(c);
                            } else {
                                //set SA as selected country by default
                                this.getCountryStats("South Africa");
                            }
                        })
                        .catch(error => console.log(error));

                    //sort
                    this.countriesList.sort(this.compare);

                    //get world news
                    this.newsWorld.articles.forEach(article => {
                        this.newsArticlesWorld.push(article);
                    });

                    //set top countries radar chart
                    this.topChartData = {
                        labels: this.getTopLabels(),
                        datasets: [
                            {
                                label: "Deaths",
                                backgroundColor: "#FD71A2",
                                borderColor: "#FD71A2",
                                data: this.getTopDeaths(),
                                fill: false
                            },
                            {
                                label: "Cases",
                                fill: false,
                                backgroundColor: "#574B90",
                                borderColor: "#574B90",
                                data: this.getTopCases()
                            },
                            {
                                label: "Recovered",
                                fill: false,
                                backgroundColor: "#30C89D",
                                borderColor: "#30C89D",
                                data: this.getTopRecovered()
                            }
                        ]
                    };

                    //set world chart data
                    this.worldHistoricalChartData = {
                        labels: this.getWorldHistoryLabels(),
                        datasets: [
                            {
                                label: "Deaths",
                                backgroundColor: "#FD71A2",
                                borderColor: "#FD71A2",
                                data: this.getWorldHistoricalDeaths(),
                                fill: false
                            },
                            {
                                label: "Cases",
                                fill: false,
                                backgroundColor: "#574B90",
                                borderColor: "#574B90",
                                data: this.getWorldHistoricalCases()
                            },
                            {
                                label: "Recovered",
                                fill: false,
                                backgroundColor: "#30C89D",
                                borderColor: "#30C89D ",
                                data: this.getWorldHistoricalRecovered()
                            }
                        ]
                    };

                    this.worldPast7ChartData = {
                        labels: this.worldHistoricalChartData.labels.slice(
                            this.worldHistoricalChartData.labels.length - 7
                        ),
                        datasets: [
                            {
                                label: "Deaths",
                                backgroundColor: "#FD71A2",
                                borderColor: "#FD71A2",
                                data: this.worldHistoricalChartData.datasets[0].data.slice(
                                    this.worldHistoricalChartData.labels.length - 7
                                ),
                                fill: false
                            },
                            {
                                label: "Cases",
                                fill: false,
                                backgroundColor: "#574B90",
                                borderColor: "#574B90",
                                data: this.worldHistoricalChartData.datasets[1].data.slice(
                                    this.worldHistoricalChartData.labels.length - 7
                                )
                            },
                            {
                                label: "Recovered",
                                fill: false,
                                backgroundColor: "#30C89D",
                                borderColor: "#30C89D",
                                data: this.worldHistoricalChartData.datasets[2].data.slice(
                                    this.worldHistoricalChartData.labels.length - 7
                                )
                            }
                        ]
                    };

                    this.updatedAt = new Date().toString().substr(0, 25);
                });
            },
            sortByDeaths(a, b) {                
                        
                const countryA = a.deaths;
                const countryB = b.deaths;

                let comparison = 0;
                if (countryA < countryB) {
                    comparison = 1;
                } else if (countryA > countryB) {
                    comparison = -1;
                }
                return comparison;
            
            },
            sortByCases(a, b) {                
                        
                const countryA = a.cases;
                const countryB = b.cases;

                let comparison = 0;
                if (countryA < countryB) {
                    comparison = 1;
                } else if (countryA > countryB) {
                    comparison = -1;
                }
                return comparison;
            
            },
            sortByRecovered(a, b) {                
                        
                const countryA = a.recovered;
                const countryB = b.recovered;

                let comparison = 0;
                if (countryA < countryB) {
                    comparison = 1;
                } else if (countryA > countryB) {
                    comparison = -1;
                }
                return comparison;
            
            },
            sortByDeathsToday(a, b) {                
                        
                const countryA = a.todayDeaths;
                const countryB = b.todayDeaths;

                let comparison = 0;
                if (countryA < countryB) {
                    comparison = 1;
                } else if (countryA > countryB) {
                    comparison = -1;
                }
                return comparison;
            
            },
            sortByCasesToday(a, b) {                
                        
                const countryA = a.todayCases;
                const countryB = b.todayCases;

                let comparison = 0;
                if (countryA < countryB) {
                    comparison = 1;
                } else if (countryA > countryB) {
                    comparison = -1;
                }
                return comparison;
            
            },
            toggleWorldInfo() {
                this.worldInfoToggle = !this.worldInfoToggle;
                var element = document.getElementById("addInfoWorld");
                var offset = 60;
                const bodyRect = document.body.getBoundingClientRect().top;
                const elementRect = element.getBoundingClientRect().top;
                const elementPosition = elementRect - bodyRect;
                const offsetPosition = elementPosition - offset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: "smooth"
                });
            },
            toggleCountryInfo() {
                this.countryInfoToggle = !this.countryInfoToggle;
            },
            toggleTopInfo() {
                this.topInfoToggle = !this.topInfoToggle;
            },
            toggleNewsSa() {
                this.newsSaToggle = !this.newsSaToggle;
            },
            toggleNewsWorld() {
                this.newsWorldToggle = !this.newsWorldToggle;
            },
            toggleCharts() {
                this.chartsToggle = !this.chartsToggle;
                var element = document.getElementById("chartsCountry");
                var offset = 60;
                const bodyRect = document.body.getBoundingClientRect().top;
                const elementRect = element.getBoundingClientRect().top;
                const elementPosition = elementRect - bodyRect;
                const offsetPosition = elementPosition - offset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: "smooth"
                });
            },
            toggleWorldCharts() {
                this.chartsWorldToggle = !this.chartsWorldToggle;
                var element = document.getElementById("chartsWorld");
                var offset = 60;
                const bodyRect = document.body.getBoundingClientRect().top;
                const elementRect = element.getBoundingClientRect().top;
                const elementPosition = elementRect - bodyRect;
                const offsetPosition = elementPosition - offset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: "smooth"
                });
            },
            toggleAddStats() {
                this.addStatsToggle = !this.addStatsToggle;
                var element = document.getElementById("addInfoCountry");
                var offset = 60;
                const bodyRect = document.body.getBoundingClientRect().top;
                const elementRect = element.getBoundingClientRect().top;
                const elementPosition = elementRect - bodyRect;
                const offsetPosition = elementPosition - offset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: "smooth"
                });
            },
            toggleProvinces() {
                this.provincesToggle = !this.provincesToggle;
                var element = document.getElementById("provincesCountry");
                var offset = 60;
                const bodyRect = document.body.getBoundingClientRect().top;
                const elementRect = element.getBoundingClientRect().top;
                const elementPosition = elementRect - bodyRect;
                const offsetPosition = elementPosition - offset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: "smooth"
                });
            },
            manageCustomList() {
                this.showManageModal = true;
            },
            closeCustomModal() {
                this.showManageModal = false;
                localStorage.customList = JSON.stringify(this.customList);
            },
            onChangeSort(event) {
                this.getData(event.target.value);
                this.sortBy = event.target.value;
            },
            viewCountryStatsOnClick(country) {
                window.scrollTo(0, 0);
                this.$cookie.set("country", country, 100);
                this.getCountryStats(country);
            },
            getCountryStats(country) {
                this.countriesData.forEach(element => {
                    if (element.country.toLowerCase() == country.toLowerCase()) {
                        this.selectedCountry.flag = element.countryInfo.flag;
                        this.selectedCountry.id = element.countryInfo._id;
                        this.selectedCountry.name = element.country;
                        this.selectedCountry.deaths = element.deaths;
                        this.selectedCountry.cases = element.cases;
                        this.selectedCountry.recovered = element.recovered;

                        this.countryCases = element.cases;
                        this.countryDeaths = element.deaths;
                        this.countryCasesToday = element.todayCases;
                        this.countryDeathsToday = element.todayDeaths;
                        this.countryActive = element.active;
                        this.countryCritical = element.critical;
                        this.countryRecovered = element.recovered;
                        this.countryCasesPerMil = element.casesPerOneMillion;
                        this.countryDeathsPerMil = element.deathsPerOneMillion;
                        this.countryTests = element.tests;
                        this.countryTestsPerMil = element.testsPerOneMillion;
                        this.countryPosGlobalDeaths = this.getCountryPosGlobalDeaths(
                            element.country
                        );
                        this.countryPosGlobalCases = this.getCountryPosGlobalCases(
                            element.country
                        );
                        this.countryPosGlobalRecoveries = this.getCountryPosGlobalRecoveries(
                            element.country
                        );
                        this.countryPosGlobalDeathsByRate = this.getCountryPosGlobalDeathsByRate(
                            element.country
                        );
                        this.countryFirstCase = this.getCountryFirstCase(element.country);
                        this.countryFirstDeath = this.getCountryFirstDeath(element.country);
                        this.countryFirstRecovered = this.getCountryFirstRecovered(
                            element.country
                        );

                        this.loading = false;

                        this.historicalChartData = {
                            labels: this.getHistoryLabels(country, this.countryFirstCase),
                            datasets: [
                                {
                                    label: "Deaths " + country,
                                    backgroundColor: "#FD71A2",
                                    borderColor: "#FD71A2",
                                    data: this.getHistoricalDeaths(country, this.countryFirstCase),
                                    fill: false
                                },
                                {
                                    label: "Cases " + country,
                                    fill: false,
                                    backgroundColor: "#574B90",
                                    borderColor: "#574B90",
                                    data: this.getHistoricalCases(country, this.countryFirstCase)
                                },
                                {
                                    label: "Recovered " + country,
                                    fill: false,
                                    backgroundColor: "#30C89D",
                                    borderColor: "#30C89D ",
                                    data: this.getHistoricalRecovered(
                                        country,
                                        this.countryFirstCase
                                    )
                                }
                            ]
                        };

                        this.past7ChartData = {
                            labels: this.historicalChartData.labels.slice(
                                this.historicalChartData.labels.length - 7
                            ),
                            datasets: [
                                {
                                    label: "Deaths " + country,
                                    backgroundColor: "#FD71A2",
                                    borderColor: "#FD71A2",
                                    data: this.historicalChartData.datasets[0].data.slice(
                                        this.historicalChartData.labels.length - 7
                                    ),
                                    fill: false
                                },
                                {
                                    label: "Cases " + country,
                                    fill: false,
                                    backgroundColor: "#574B90",
                                    borderColor: "#574B90",
                                    data: this.historicalChartData.datasets[1].data.slice(
                                        this.historicalChartData.labels.length - 7
                                    )
                                },
                                {
                                    label: "Recovered " + country,
                                    fill: false,
                                    backgroundColor: "#30C89D",
                                    borderColor: "#30C89D",
                                    data: this.historicalChartData.datasets[2].data.slice(
                                        this.historicalChartData.labels.length - 7
                                    )
                                }
                            ]
                        };
                    }
                });

                //get yesterdays data
                this.countriesDataYesterday.forEach(element => {
                    if (element.country.toLowerCase() == country.toLowerCase()) {
                        this.countryCasesYesterday = element.todayCases;
                        this.countryDeathsYesterday = element.todayDeaths;
                    }
                });

                //Get Country News if Sa
                this.getCountryNews();
            },
            onChangeCountry() {
                this.$cookie.set("country", this.selectedCountry.name, 100);
                this.getCountryStats(this.selectedCountry.name);
            },
            getCountryNews() {
                this.newsSa.articles.forEach(article => {
                    this.newsArticlesSa.push(article);
                });
            },
            getWorldHistoryLabels() {
                let arr = [];

                for (let key in this.historicalData[0].timeline.cases) {
                    var res = key.split("/");
                    arr.push(res[1] + "-" + res[0]);
                }

                return arr;
            },
            getWorldHistoricalDeaths() {
                let arr = [];
                for (let key in this.historicalData[0].timeline.cases) {
                    arr.push(0);
                }

                this.historicalData.forEach(country => {
                    let i = 0;
                    for (let key in country.timeline.deaths) {
                        arr[i] += country.timeline.deaths[key];
                        i++;
                    }
                });

                return arr;
            },
            getWorldHistoricalCases() {
                let arr = [];
                for (let key in this.historicalData[0].timeline.cases) {
                    arr.push(0);
                }

                this.historicalData.forEach(country => {
                    let i = 0;
                    for (let key in country.timeline.cases) {
                        arr[i] += country.timeline.cases[key];
                        i++;
                    }
                });

                return arr;
            },
            getWorldHistoricalRecovered() {
                let arr = [];
                for (let key in this.historicalData[0].timeline.cases) {
                    arr.push(0);
                }

                this.historicalData.forEach(country => {
                    let i = 0;
                    for (let key in country.timeline.recovered) {
                        arr[i] += country.timeline.recovered[key];
                        i++;
                    }
                });

                return arr;
            },
            getHistoryLabels(country, firstCaseDate) {
                let arr = [];
                let started = false;
                this.historicalData.forEach(elem => {
                    if (elem.country.toLowerCase() == country.toLowerCase()) {
                        for (let key in elem.timeline.cases) {
                            if (key == firstCaseDate || started) {
                                var res = key.split("/");
                                arr.push(res[1] + "-" + res[0]);
                                started = true;
                            }
                        }
                    }
                });
                return arr;
            },
            getHistoricalDeaths(country, firstCaseDate) {
                let arr = [];
                let started = false;
                this.historicalData.forEach(elem => {
                    if (elem.country.toLowerCase() == country.toLowerCase()) {
                        for (let key in elem.timeline.deaths) {
                            if (key == firstCaseDate || started) {
                                arr.push(elem.timeline.deaths[key]);
                                started = true;
                            }
                        }
                    }
                });
                return arr;
            },
            getHistoricalCases(country, firstCaseDate) {
                let arr = [];
                let started = false;
                this.historicalData.forEach(elem => {
                    if (elem.country.toLowerCase() == country.toLowerCase()) {
                        for (let key in elem.timeline.cases) {
                            if (key == firstCaseDate || started) {
                                arr.push(elem.timeline.cases[key]);
                                started = true;
                            }
                        }
                    }
                });
                return arr;
            },
            getHistoricalRecovered(country, firstCaseDate) {
                let arr = [];
                let started = false;
                this.historicalData.forEach(elem => {
                    if (elem.country.toLowerCase() == country.toLowerCase()) {
                        for (let key in elem.timeline.recovered) {
                            if (key == firstCaseDate || started) {
                                arr.push(elem.timeline.recovered[key]);
                                started = true;
                            }
                        }
                    }
                });
                return arr;
            },
            getTopLabels() {
                let arr = [];
                for (let i = 0; i < this.topDropDownInt; i++) {
                    arr.push(this.countriesData[i].country);
                }
                return arr;
            },
            getTopDeaths() {
                let arr = [];
                for (let i = 0; i < this.topDropDownInt; i++) {
                    arr.push(this.countriesData[i].deaths);
                }
                return arr;
            },
            getTopCases() {
                let arr = [];
                for (let i = 0; i < this.topDropDownInt; i++) {
                    arr.push(this.countriesData[i].cases);
                }
                return arr;
            },
            getTopRecovered() {
                let arr = [];
                for (let i = 0; i < this.topDropDownInt; i++) {
                    arr.push(this.countriesData[i].recovered);
                }
                return arr;
            },
            getCountryPosGlobalDeaths(country) {
                let dl = this.countriesList.slice(0);
                dl.sort(function (a, b) {
                    const countryA = a.deaths;
                    const countryB = b.deaths;

                    let comparison = 0;
                    if (countryA < countryB) {
                        comparison = 1;
                    } else if (countryA > countryB) {
                        comparison = -1;
                    }
                    return comparison;
                });
                let pos = 1;
                for (var i = 0; i < dl.length; ++i) {
                    if (dl[i].name.toLowerCase() == country.toLowerCase()) {
                        break;
                    } else {
                        pos++;
                    }
                }

                return pos;
            },
            getCountryPosGlobalDeathsByRate(country) {
                let dl = this.countriesList.slice(0);
                dl.sort(function (a, b) {
                    const countryA = (a.deaths / a.cases) * 100;
                    const countryB = (b.deaths / b.cases) * 100;
                    let comparison = 0;
                    if (countryA > countryB) {
                        comparison = 1;
                    } else if (countryA < countryB) {
                        comparison = -1;
                    }
                    return comparison;
                });

                let pos = 1;
                for (var i = 0; i < dl.length; ++i) {
                    if (dl[i].name.toLowerCase() == country.toLowerCase()) {
                        break;
                    } else {
                        pos++;
                    }
                }

                return pos;
            },

            getCountryPosGlobalCases(country) {
                let dl = this.countriesList.slice(0);
                dl.sort(function (a, b) {
                    const countryA = a.cases;
                    const countryB = b.cases;

                    let comparison = 0;
                    if (countryA < countryB) {
                        comparison = 1;
                    } else if (countryA > countryB) {
                        comparison = -1;
                    }
                    return comparison;
                });
                let pos = 1;
                for (var i = 0; i < dl.length; ++i) {
                    if (dl[i].name.toLowerCase() == country.toLowerCase()) {
                        break;
                    } else {
                        pos++;
                    }
                }

                return pos;
            },
            getCountryPosGlobalRecoveries(country) {
                let dl = this.countriesList.slice(0);
                dl.sort(function (a, b) {
                    const countryA = a.recovered;
                    const countryB = b.recovered;

                    let comparison = 0;
                    if (countryA < countryB) {
                        comparison = 1;
                    } else if (countryA > countryB) {
                        comparison = -1;
                    }
                    return comparison;
                });
                let pos = 1;
                for (var i = 0; i < dl.length; ++i) {
                    if (dl[i].name.toLowerCase() == country.toLowerCase()) {
                        break;
                    } else {
                        pos++;
                    }
                }

                return pos;
            },
            getCountryFirstCase(country) {
                let v = "";
                this.historicalData.forEach(elem => {
                    if (elem.country.toLowerCase() == country.toLowerCase()) {
                        for (let key in elem.timeline.cases) {
                            if (elem.timeline.cases[key] > 0) {
                                v = key;
                                break;
                            }
                        }
                    }
                });
                return v;
            },
            getCountryFirstDeath(country) {
                let v = "";
                this.historicalData.forEach(elem => {
                    if (elem.country.toLowerCase() == country.toLowerCase()) {
                        for (let key in elem.timeline.deaths) {
                            if (elem.timeline.deaths[key] > 0) {
                                v = key;
                                break;
                            }
                        }
                    }
                });
                return v;
            },
            getCountryFirstRecovered(country) {
                let v = "";
                this.historicalData.forEach(elem => {
                    if (elem.country.toLowerCase() == country.toLowerCase()) {
                        for (let key in elem.timeline.recovered) {
                            if (elem.timeline.recovered[key] > 0) {
                                v = key;
                                break;
                            }
                        }
                    }
                });
                return v;
            },
            compareCountries() {
                if (this.vsSelectedCountry == "") {
                    alert("Please select a country");
                } else {
                    this.countriesCompared = true;
                    this.countriesData.forEach(element => {
                        if (
                            element.country.toLowerCase() ==
                            this.vsSelectedCountry.name.toLowerCase()
                        ) {
                            this.vsSelectedCountry.flag = element.countryInfo.flag;
                            this.vsSelectedCountry.id = element.countryInfo._id;
                            this.vsSelectedCountry.name = element.country;
                            this.vsSelectedCountry.deaths = element.deaths;
                            this.vsSelectedCountry.cases = element.cases;
                            this.vsSelectedCountry.recovered = element.recovered;

                            this.vsCountryCases = element.cases;
                            this.vsCountryDeaths = element.deaths;
                            this.vsCountryCasesToday = element.todayCases;
                            this.vsCountryDeathsToday = element.todayDeaths;
                            this.vsCountryActive = element.active;
                            this.vsCountryCritical = element.critical;
                            this.vsCountryRecovered = element.recovered;
                            this.vsCountryCasesPerMil = element.casesPerOneMillion;
                            this.vsCountryTests = element.tests;
                            this.vsCountryTestsPerMil = element.testsPerOneMillion;
                            this.vsCountryDeathsPerMil = element.deathsPerOneMillion;
                            this.vsCountryPosGlobalDeaths = this.getCountryPosGlobalDeaths(
                                element.country
                            );
                            this.vsCountryPosGlobalDeathsByRate = this.getCountryPosGlobalDeathsByRate(
                                element.country
                            );
                            this.vsCountryPosGlobalCases = this.getCountryPosGlobalCases(
                                element.country
                            );
                            this.vsCountryPosGlobalRecoveries = this.getCountryPosGlobalRecoveries(
                                element.country
                            );
                            this.vsCountryFirstCase = this.getCountryFirstCase(element.country);
                            this.vsCountryFirstDeath = this.getCountryFirstDeath(
                                element.country
                            );
                            this.vsCountryFirstRecovered = this.getCountryFirstRecovered(
                                element.country
                            );

                            this.vsHistoricalChartData = {
                                labels: this.getHistoryLabels(
                                    element.country,
                                    this.countryFirstCase
                                ),
                                datasets: [
                                    {
                                        label: "Deaths " + element.country,
                                        backgroundColor: "#FD71A2",
                                        borderColor: "#FD71A2",
                                        data: this.getHistoricalDeaths(
                                            element.country,
                                            this.countryFirstCase
                                        ),
                                        fill: false
                                    },
                                    {
                                        label: "Cases " + element.country,
                                        fill: false,
                                        backgroundColor: "#574B90",
                                        borderColor: "#574B90",
                                        data: this.getHistoricalCases(
                                            element.country,
                                            this.countryFirstCase
                                        )
                                    },
                                    {
                                        label: "Recovered " + element.country,
                                        fill: false,
                                        backgroundColor: "#30C89D",
                                        borderColor: "#30C89D",
                                        data: this.getHistoricalRecovered(
                                            element.country,
                                            this.countryFirstCase
                                        )
                                    },
                                    {
                                        label: "Deaths " + this.selectedCountry.name,
                                        backgroundColor: "#CD6155",
                                        borderColor: "#CD6155",
                                        data: this.getHistoricalDeaths(
                                            this.selectedCountry.name,
                                            this.countryFirstCase
                                        ),
                                        fill: false
                                    },
                                    {
                                        label: "Cases " + this.selectedCountry.name,
                                        fill: false,
                                        backgroundColor: "#F1C40F",
                                        borderColor: "#F1C40F",
                                        data: this.getHistoricalCases(
                                            this.selectedCountry.name,
                                            this.countryFirstCase
                                        ),
                                        fill: false
                                    },
                                    {
                                        label: "Recovered " + this.selectedCountry.name,
                                        fill: false,
                                        backgroundColor: "#5DADE2",
                                        borderColor: "#5DADE2",
                                        data: this.getHistoricalRecovered(
                                            this.selectedCountry.name,
                                            this.countryFirstCase
                                        ),
                                        fill: false
                                    }
                                ]
                            };

                            this.vsPast7ChartData = {
                                labels: this.vsHistoricalChartData.labels.slice(
                                    this.vsHistoricalChartData.labels.length - 7
                                ),
                                datasets: [
                                    {
                                        label: "Deaths " + element.country,
                                        backgroundColor: "#FD71A2",
                                        borderColor: "#FD71A2",
                                        data: this.vsHistoricalChartData.datasets[0].data.slice(
                                            this.vsHistoricalChartData.labels.length - 7
                                        ),
                                        fill: false
                                    },
                                    {
                                        label: "Cases " + element.country,
                                        fill: false,
                                        backgroundColor: "#574B90",
                                        borderColor: "#574B90",
                                        data: this.vsHistoricalChartData.datasets[1].data.slice(
                                            this.vsHistoricalChartData.labels.length - 7
                                        )
                                    },
                                    {
                                        label: "Recovered " + element.country,
                                        fill: false,
                                        backgroundColor: "#30C89D",
                                        borderColor: "#30C89D",
                                        data: this.vsHistoricalChartData.datasets[2].data.slice(
                                            this.vsHistoricalChartData.labels.length - 7
                                        )
                                    },
                                    {
                                        label: "Deaths " + this.selectedCountry.name,
                                        backgroundColor: "#CD6155",
                                        borderColor: "#CD6155",
                                        data: this.historicalChartData.datasets[0].data.slice(
                                            this.historicalChartData.labels.length - 7
                                        ),
                                        fill: false
                                    },
                                    {
                                        label: "Cases " + this.selectedCountry.name,
                                        fill: false,
                                        backgroundColor: "#F1C40F",
                                        borderColor: "#F1C40F",
                                        data: this.historicalChartData.datasets[1].data.slice(
                                            this.historicalChartData.labels.length - 7
                                        )
                                    },
                                    {
                                        label: "Recovered " + this.selectedCountry.name,
                                        fill: false,
                                        backgroundColor: "#5DADE2",
                                        borderColor: "#5DADE2",
                                        data: this.historicalChartData.datasets[2].data.slice(
                                            this.historicalChartData.labels.length - 7
                                        )
                                    }
                                ]
                            };
                        }
                    });
                }
            },
            numberSuffix(number) {
                switch (
                    number
                        .toString()
                        .split("")
                        .pop()
                    ) {
                    case "0":
                        return "th";
                    case "1":
                        return "st";
                    case "2":
                        return "nd";
                    case "3":
                        return "rd";
                    case "4":
                        return "th";
                    case "5":
                        return "th";
                    case "6":
                        return "th";
                    case "7":
                        return "th";
                    case "8":
                        return "th";
                    case "9":
                        return "th";
                }
            },
            compare(a, b) {
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
        font-size: 10px;
    }

    .font-compare {
        font-size: 12px;
    }
</style>

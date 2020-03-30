<template>
    <div>
        <div class="container">
            <div class="row mt-5">
                <!-- country data column-->
                <div class="col-lg-4">
                    <!-- country data -->
                    <div class="p-3 b-12 border">
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
                                        >{{ country.name }}</option
                                    >
                                </select>
                            </div>
                        </div>


                        

                        
                               
                                <div class="stat-row mt-4">
                                   <div class="row">
                                        <div class="col-auto">
                                            <span class="text-secodary "
                                                >Cases</span
                                            >
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
                                            <span class="text-danger "
                                                >Deaths</span
                                            >
                                        </div>
                                        <div class="col text-right">
                                            <h5 class="text-danger m-0">
                                                <small
                                                    class="text-black-50 font-percent"
                                                    >({{
                                                        (
                                                            (countryDeaths /
                                                                countryCases) *
                                                            100
                                                        ).toFixed(2)
                                                    }}%)</small
                                                >
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
                                            <span class="text-success ">
                                                Recovered
                                            </span>
                                        </div>
                                        <div class="col text-right">
                                            <h5 class="m-0 text-success">
                                                <small
                                                    class="text-black-50 font-percent m-0"
                                                    >({{
                                                        (
                                                            (countryRecovered /
                                                                countryCases) *
                                                            100
                                                        ).toFixed(2)
                                                    }}%)</small
                                                >
                                                {{
                                                    new Intl.NumberFormat().format(
                                                        countryRecovered
                                                    )
                                                }}
                                            </h5>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                            <div class="col my-auto">
                                
                                <div class="stat-row">
                                    <div class="row">
                                        <div class="col-auto">
                                            <span class="text-secodary "
                                                >Cases Today</span
                                            >
                                        </div>
                                        <div class="col text-right">
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
                                        <div class="col-auto">
                                            <span class="text-danger "
                                                >Deaths Today</span
                                            >
                                        </div>
                                        <div class="col text-right">
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

                                <div class="mt-3">
                                    <a
                                        v-show="!countryInfoToggle"
                                        v-on:click="toggleCountryInfo"
                                        class="btn btn-sm btn-light"
                                        >more stats +</a
                                    >
                                </div>
                                <div v-show="countryInfoToggle">
                                    <div class="stat-row">
                                        <div class="row">
                                            <div class="col-auto">
                                                <span>
                                                    Active Cases
                                                </span>
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
                                                <span>
                                                    Critical Cases
                                                </span>
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
                                                <span>
                                                    Cases Per Million
                                                </span>
                                            </div>
                                            <div class="col text-right">
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
                                    <div>
                                        <div class="row">
                                            <div class="col-auto">
                                                <span>
                                                    Deaths Per Million
                                                </span>
                                            </div>
                                            <div class="col text-right">
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
                                </div>
                            </div>
                        </div>

                        <div class="font-weight-bold mb-2 mt-4">
                            GLOBAL POSITION
                        </div>

                        <div class="stat-row">
                            <div class="row">
                                <div class="col-auto">
                                    <span>
                                        By Cases
                                    </span>
                                </div>
                                <div class="col text-right">
                                    <h5 class="m-0">
                                        {{ countryPosGlobalCases }}
                                        <small
                                            class="text-black-50 font-percent"
                                            >{{
                                                numberSuffix(
                                                    countryPosGlobalCases
                                                )
                                            }}</small
                                        >
                                    </h5>
                                </div>
                            </div>
                        </div>

                        <div class="stat-row">
                            <div class="row">
                                <div class="col-auto">
                                    <span>
                                        By Deaths
                                    </span>
                                </div>
                                <div class="col text-right">
                                    <h5 class="m-0">
                                        {{ countryPosGlobalDeaths }}
                                        <small
                                            class="text-black-50 font-percent"
                                            >{{
                                                numberSuffix(
                                                    countryPosGlobalDeaths
                                                )
                                            }}</small
                                        >
                                    </h5>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="row">
                                <div class="col-auto">
                                    <span>
                                        By Recoveries
                                    </span>
                                </div>
                                <div class="col text-right">
                                    <h5 class="m-0">
                                        {{ countryPosGlobalRecoveries }}
                                        <small
                                            class="text-black-50 font-percent"
                                            >{{
                                                numberSuffix(
                                                    countryPosGlobalRecoveries
                                                )
                                            }}</small
                                        >
                                    </h5>
                                </div>
                            </div>
                        </div>

                        <!-- SA News -->
                        <div v-if="selectedCountry.name == 'South Africa'">
                           <hr class="section-line"/>
                            <h4 class="mt-3">SA News Headlines</h4>

                            <div>
                                <div
                                    class="stat-row"
                                    v-for="article in newsArticlesSa.slice(
                                        0,
                                        5
                                    )"
                                    :key="article.id"
                                >
                                    <a :href="article.url">{{
                                        article.title
                                    }}</a
                                    ><br />
                                    <small class="text-black-50 font-percentage"
                                        >- {{ article.source.name }}</small
                                    >
                                </div>
                                <div class="mt-3">
                                    <a
                                        v-show="!newsSaToggle"
                                        v-on:click="toggleNewsSa"
                                        class="btn btn-sm btn-light"
                                        >more articles +</a
                                    >
                                </div>
                                <div v-if="newsSaToggle">
                                    <div
                                        class="stat-row"
                                        v-for="article in newsArticlesSa.slice(
                                            5,
                                            100
                                        )"
                                        :key="article.id"
                                    >
                                        <a :href="article.url">{{
                                            article.title
                                        }}</a
                                        ><br />
                                        <small
                                            class="text-black-50 font-percentage"
                                            >- {{ article.source.name }}</small
                                        >
                                    </div>
                                </div>
                            </div>

                      
                        </div>

                        <hr class="section-line"/>

                        <h4 class="mt-3">Compare Statistics</h4>

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
                                        >{{ country.name }}</option
                                    >
                                </select>
                            </div>
                        </div>                         

                        <div class="row text-center py-2">
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
                                <option disabled value="">Select a Country</option>
                                    <option
                                        v-for="country in countriesList"
                                        :key="country.id"
                                        :value="country"
                                        >{{ country.name }}</option
                                    >
                                </select>
                            </div>
                            
                        </div>

                        <div class="row mt-3 no-gutters" v-if="countriesCompared">
                            <!-- country 1 -->
                            <div class="col-6">
                                <div class="row">
                                    <div class="col my-auto">
                                        <div class="stat-row" style="height:50px; overflow:hidden;">
                                            <img :src="selectedCountry.flag" height="22" :alt="selectedCountry.name">
                                            <h6 class="mt-2">{{ selectedCountry.name }}</h6>
                                        </div>
                                        
                                       
                                       
                                        <div class="stat-row">
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="text-secodary font-compare"
                                                        >Cases</span
                                                    >
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
                                                    <span class="text-danger font-compare"
                                                        >Deaths</span
                                                    >
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
                                                            >({{
                                                                (
                                                                    (countryDeaths /
                                                                        countryCases) *
                                                                    100
                                                                ).toFixed(2)
                                                            }}%)</small
                                                        >
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="stat-row">
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="text-success font-compare">
                                                        Recovered
                                                    </span>
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
                                                            >({{
                                                                (
                                                                    (countryRecovered /
                                                                        countryCases) *
                                                                    100
                                                                ).toFixed(2)
                                                            }}%)</small
                                                        >
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>

                                         <div class="stat-row">
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="text-secodary font-compare"
                                                        >Cases Today</span
                                                    >
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
                                                    <span class="text-danger font-compare"
                                                        >Deaths Today</span
                                                    >
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
                                                        <span class="font-compare">
                                                            Active Cases
                                                        </span>
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
                                                        <span class="font-compare">
                                                            Critical Cases
                                                        </span>
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
                                                        <span class="font-compare">
                                                            Cases Per Million
                                                        </span>
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
                                                        <span class="font-compare">
                                                            Deaths Per Million
                                                        </span>
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
                                        </div>
                                    </div>
                                </div>

                                <div class="font-weight-bold mb-2 mt-4 ">
                                    GLOBAL POSITION
                                </div>

                                <div class="stat-row">
                                    <div class="row">
                                        <div class="col-12">
                                            <span class="font-compare">
                                                By Cases
                                            </span>
                                        </div>
                                        <div class="col">
                                            <h5 class="m-0">
                                                {{ countryPosGlobalCases }}
                                                <small
                                                    class="text-black-50 font-percent"
                                                    >{{
                                                        numberSuffix(
                                                            countryPosGlobalCases
                                                        )
                                                    }}</small
                                                >
                                            </h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="stat-row">
                                    <div class="row">
                                        <div class="col-12">
                                            <span class="font-compare">
                                                By Deaths
                                            </span>
                                        </div>
                                        <div class="col">
                                            <h5 class="m-0">
                                                {{ countryPosGlobalDeaths }}
                                                <small
                                                    class="text-black-50 font-percent"
                                                    >{{
                                                        numberSuffix(
                                                            countryPosGlobalDeaths
                                                        )
                                                    }}</small
                                                >
                                            </h5>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div class="row">
                                        <div class="col-12">
                                            <span class="font-compare">
                                                By Recoveries
                                            </span>
                                        </div>
                                        <div class="col">
                                            <h5 class="m-0">
                                                {{ countryPosGlobalRecoveries }}
                                                <small
                                                    class="text-black-50 font-percent"
                                                    >{{
                                                        numberSuffix(
                                                            countryPosGlobalRecoveries
                                                        )
                                                    }}</small
                                                >
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
                                            <img :src="vsSelectedCountry.flag" height="22" :alt="vsSelectedCountry.name">
                                            <h6 class="mt-2">{{ vsSelectedCountry.name }}</h6>
                                        </div>
                                        
                                        
                                        
                                        <div class="stat-row">
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="text-white font-compare"
                                                        >Cases</span
                                                    >
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
                                                    <span class="text-white font-compare"
                                                        >Deaths</span
                                                    >
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
                                                            >({{
                                                                (
                                                                    (vsCountryDeaths /
                                                                        vsCountryCases) *
                                                                    100
                                                                ).toFixed(2)
                                                            }}%)</small
                                                        >
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="stat-row">
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="text-white font-compare">
                                                        Recovered
                                                    </span>
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
                                                            >({{
                                                                (
                                                                    (vsCountryRecovered /
                                                                        vsCountryCases) *
                                                                    100
                                                                ).toFixed(2)
                                                            }}%)</small
                                                        >
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="stat-row">
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="text-white font-compare"
                                                        >Cases Today</span
                                                    >
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
                                                    <span class="text-white font-compare"
                                                        >Deaths Today</span
                                                    >
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
                                                        <span class="font-compare text-white">
                                                            Active Cases
                                                        </span>
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
                                                        <span class="font-compare text-white">
                                                            Critical Cases
                                                        </span>
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
                                                        <span class="font-compare text-white">
                                                            Cases Per Million
                                                        </span>
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
                                                        <span class="font-compare text-white">
                                                            Deaths Per Million
                                                        </span>
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
                                        </div>
                                    </div>
                                </div>

                                <div class="font-weight-bold mb-2 mt-4  text-white">
                                    GLOBAL POSITION
                                </div>

                                <div class="stat-row">
                                    <div class="row">
                                        <div class="col-12">
                                            <span class="font-compare text-white">
                                                By Cases
                                            </span>
                                        </div>
                                        <div class="col">
                                            <h5 class="m-0">
                                                {{ vsCountryPosGlobalCases }}
                                                <small
                                                    class="text-black-50 font-percent"
                                                    >{{
                                                        numberSuffix(
                                                            vsCountryPosGlobalCases
                                                        )
                                                    }}</small
                                                >
                                            </h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="stat-row">
                                    <div class="row">
                                        <div class="col-12">
                                            <span class="font-compare text-white">
                                                By Deaths
                                            </span>
                                        </div>
                                        <div class="col">
                                            <h5 class="m-0">
                                                {{ vsCountryPosGlobalDeaths }}
                                                <small
                                                    class="text-black-50 font-percent"
                                                    >{{
                                                        numberSuffix(
                                                            vsCountryPosGlobalDeaths
                                                        )
                                                    }}</small
                                                >
                                            </h5>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div class="row">
                                        <div class="col-12">
                                            <span class="font-compare text-white">
                                                By Recoveries
                                            </span>
                                        </div>
                                        <div class="col">
                                            <h5 class="m-0">
                                                {{ vsCountryPosGlobalRecoveries }}
                                                <small
                                                    class="text-black-50 font-percent"
                                                    >{{
                                                        numberSuffix(
                                                            vsCountryPosGlobalRecoveries
                                                        )
                                                    }}</small
                                                >
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                            
                       

                        <hr class="section-line"/>

                        <h4 class="mt-3">{{ selectedCountry.name }} Historical</h4>

                        <!-- past 7 days -->
                        <line-chart
                            class="mt-3"
                            :chart-data="past7ChartData"
                            :options="past7ChartOptions"
                        />

                        <hr />

                        <!-- History Graph -->
                        <line-chart
                            class="mt-2"
                            :chart-data="historicalChartData"
                            :options="historicalChartOptions"
                        />

                        <div v-if="vsSelectedCountry != ''">
                             <h4 class="mt-3">{{ vsSelectedCountry.name }} Historical</h4>

                            <!-- past 7 days -->
                            <line-chart
                                class="mt-3"
                                :chart-data="vsPast7ChartData"
                                :options="vsPast7ChartOptions"
                            />

                            <hr />

                            <!-- History Graph -->
                            <line-chart
                                class="mt-2"
                                :chart-data="vsHistoricalChartData"
                                :options="vsHistoricalChartOptions"
                            />
                        </div>
                    </div>
                </div>
                <!-- /country column -->

                <!-- world data column-->
                <div class="col-lg-4 mt-5 mt-lg-0">
                    <!-- world Data -->
                    <div class="p-3 border b-12">
                        <div class="row">
                            <div class="col-auto">
                                <img src="/img/world.png" alt="world" />
                            </div>
                            <div class="col-auto">
                                <h4 class="m-0 p-0">The World</h4>
                                <small class="text-muted m-0 p-0"
                                    >{{ countriesAffected }} Countries
                                    affected</small
                                >
                            </div>
                        </div>

                       
                        <div class="mt-2">
                            <div class="row">
                                <div class="col my-auto">
                                    <div class="font-weight-bold my-2">
                                        TODAY'S STATS
                                    </div>
                                    <div class="stat-row">
                                        <div class="row">
                                            <div class="col-auto">
                                                <span class="">Cases</span>
                                            </div>
                                            <div class="col text-right">
                                                <h5 class="m-0">
                                                    {{
                                                        new Intl.NumberFormat().format(
                                                            worldCasesToday
                                                        )
                                                    }}
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="stat-row">
                                        <div class="row">
                                            <div class="col-auto">
                                                <span class="text-danger "
                                                    >Deaths</span
                                                >
                                            </div>
                                            <div class="col text-right">
                                                <h5 class="text-danger m-0">
                                                    {{
                                                        new Intl.NumberFormat().format(
                                                            worldDeathsToday
                                                        )
                                                    }}
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="font-weight-bold mt-4 mb-2">
                                        ALL TIME STATS
                                    </div>
                                    <div class="stat-row">
                                        <div class="row">
                                            <div class="col-auto">
                                                <span class="">Cases</span>
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
                                                <span class="text-danger "
                                                    >Deaths</span
                                                >
                                            </div>
                                            <div class="col text-right">
                                                <h5 class="text-danger m-0">
                                                    <small
                                                        class="text-black-50 font-percent"
                                                        >({{
                                                            (
                                                                (worldDeaths /
                                                                    worldCases) *
                                                                100
                                                            ).toFixed(2)
                                                        }}%)</small
                                                    >
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
                                                <span class="text-success ">
                                                    Recovered
                                                </span>
                                            </div>
                                            <div class="col text-right">
                                                <h5 class="m-0 text-success">
                                                    <small
                                                        class="text-black-50 font-percent m-0"
                                                        >({{
                                                            (
                                                                (worldRecovered /
                                                                    worldCases) *
                                                                100
                                                            ).toFixed(2)
                                                        }}%)</small
                                                    >
                                                    {{
                                                        new Intl.NumberFormat().format(
                                                            worldRecovered
                                                        )
                                                    }}
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <a
                                            v-show="!worldInfoToggle"
                                            v-on:click="toggleWorldInfo"
                                            class="btn btn-sm btn-light"
                                            >more stats +</a
                                        >
                                    </div>
                                    <div v-show="worldInfoToggle">
                                        <div class="stat-row">
                                            <div class="row">
                                                <div class="col-auto">
                                                    <span>
                                                        Active Cases
                                                    </span>
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
                                                    <span>
                                                        Critical Cases
                                                    </span>
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
                                                    <span>
                                                        Cases Per Million
                                                    </span>
                                                </div>
                                                <div class="col text-right">
                                                    <h5 class="m-0">
                                                        {{
                                                            new Intl.NumberFormat().format(
                                                                worldCasesPerMil
                                                            )
                                                        }}
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="row">
                                                <div class="col-auto">
                                                    <span>
                                                        Deaths Per Million
                                                    </span>
                                                </div>
                                                <div class="col text-right">
                                                    <h5 class="m-0">
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

                            <hr class="section-line"/>

                            <h4 class="mt-3">World News Headlines</h4>
                            <div>
                                <div
                                    class="stat-row"
                                    v-for="article in newsArticlesWorld.slice(
                                        0,
                                        5
                                    )"
                                    :key="article.id"
                                >
                                    <a :href="article.url">{{
                                        article.title
                                    }}</a
                                    ><br />
                                    <small class="text-black-50 font-percentage"
                                        >- {{ article.source.name }}</small
                                    >
                                </div>
                                <div class="mt-3">
                                    <a
                                        v-show="!newsWorldToggle"
                                        v-on:click="toggleNewsWorld"
                                        class="btn btn-sm btn-light"
                                        >more articles +</a
                                    >
                                </div>
                                <div v-if="newsWorldToggle">
                                    <div
                                        class="stat-row"
                                        v-for="article in newsArticlesWorld.slice(
                                            5,
                                            25
                                        )"
                                        :key="article.id"
                                    >
                                        <a :href="article.url">{{
                                            article.title
                                        }}</a
                                        ><br />
                                        <small
                                            class="text-black-50 font-percentage"
                                            >- {{ article.source.name }}</small
                                        >
                                    </div>
                                </div>
                            </div>
                        

                        </div>
                    </div>
                </div>
                <!-- /world data column -->
                <!-- Top 10 data column-->
                <div class="col-lg-4">
                    <div
                        class="mt-5 mt-lg-0 border p-3 b-12"
                    >
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
                                </select>
                                Countries
                            </h4>
                            <div class="row no-gutters">
                                <div class="col-auto">
                                    <h6 class="mr-1 mt-1">Sorted By:</h6>
                                </div>
                                <div class="col">
                                    <select
                                        class="form-control form-control-sm"
                                        @change="onChangeSort($event)"
                                    >
                                        <option selected value="deaths"
                                            >Most Deaths</option
                                        >
                                        <option value="cases">
                                            Most Cases
                                        </option>
                                        <option value="recovered"
                                            >Most Recovered</option
                                        >
                                        <option value="todayCases"
                                            >Most Cases Today</option
                                        >
                                        <option value="todayDeaths"
                                            >Most Deaths Today</option
                                        >
                                    </select>
                                </div>
                            </div>
                        </div>

                     

                        <radar-chart
                            class="mb-3 mt-2"
                            :chart-data="topChartData"
                            :options="topChartOptions"
                        />

                        <div
                            class="border b-12 p-3 mb-3"
                            v-for="(country, i) in countriesData.slice(
                                0,
                                topDropDownInt
                            )"
                            :key="country.country"
                        >
                            <div class="row my-2">
                                <div class="col-3">
                                    <img
                                        :src="country.countryInfo.flag"
                                        class="img-fluid"
                                        :alt="country.country"
                                    />
                                </div>
                                <div class="col-7">
                                    <h4>{{ country.country }}</h4>
                                </div>
                                <div class="col-2">
                                    <span class="badge badge-primary"
                                        >#{{ i + 1 }}</span
                                    >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col my-auto">
                                    <div class="stat-row">
                                        <div class="row">
                                            <div class="col-auto">
                                                <span class="">Cases</span>
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
                                                <span class="text-danger "
                                                    >Deaths</span
                                                >
                                            </div>
                                            <div class="col text-right">
                                                <h5 class="text-danger m-0">
                                                    <small
                                                        class="text-black-50 font-percent"
                                                        >({{
                                                            (
                                                                (country.deaths /
                                                                    country.cases) *
                                                                100
                                                            ).toFixed(2)
                                                        }}%)</small
                                                    >
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
                                                <span class="text-success ">
                                                    Recovered
                                                </span>
                                            </div>
                                            <div class="col text-right">
                                                <h5 class="m-0 text-success">
                                                    <small
                                                        class="text-black-50 font-percent m-0"
                                                        >({{
                                                            (
                                                                (country.recovered /
                                                                    country.cases) *
                                                                100
                                                            ).toFixed(2)
                                                        }}%)</small
                                                    >
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
                                                <span class="text-danger "
                                                    >Deaths Today</span
                                                >
                                            </div>
                                            <div class="col text-right">
                                                <h5 class="text-danger m-0">
                                                    <small
                                                        class="text-black-50 font-percent"
                                                        v-show="
                                                            country.todayCases >
                                                                0
                                                        "
                                                        >({{
                                                            (
                                                                (country.todayDeaths /
                                                                    country.todayCases) *
                                                                100
                                                            ).toFixed(2)
                                                        }}%)</small
                                                    >
                                                    {{
                                                        new Intl.NumberFormat().format(
                                                            country.todayDeaths
                                                        )
                                                    }}
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <a
                                            v-show="!topInfoToggle"
                                            v-on:click="toggleTopInfo"
                                            class="btn btn-sm btn-light"
                                            >more stats +</a
                                        >
                                    </div>
                                    <div v-show="topInfoToggle">                                       
                                        
                                        <div class="stat-row">
                                            <div class="row">
                                                <div class="col-auto">
                                                    <span>
                                                        Active Cases
                                                    </span>
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
                                                    <span>
                                                        Critical Cases
                                                    </span>
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
                                                    <span>
                                                        Cases Per Million
                                                    </span>
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
                                                    <span>
                                                        Deaths Per Million
                                                    </span>
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
                <!-- /end top 10 data col -->
            </div>
            <!-- /row  -->
        </div>
        <!-- /container  -->
        <!-- Updated -->
        <div class="container my-3 text-center">
            <div class="row">
                <div class="col-12">
                    <div class="border b-12 p-1">
                        <small class="text-black-50 font-percent"
                            >Updated At</small
                        >
                        <p class="m-0">
                            <strong> {{ updatedAt }}</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
const covid = require("novelcovid");
import LineChart from "./LineChartComponent";
import RadarChart from "./RadarChartComponent";

export default {
    components: { LineChart, RadarChart },
    props: ["newsSa", "newsWorld", "historicalData"],

    data: function() {
        return {
            updatedAt: "",

            historicalChartData: null,
            historicalChartOptions: {
                responsive: true,
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
                                display: true,
                                labelString: "Value"
                            }
                        }
                    ]
                }
            },

            past7ChartData: null,
            past7ChartOptions: {
                responsive: true,
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
                                display: true,
                                labelString: "Value"
                            }
                        }
                    ]
                }
            },

            vsHistoricalChartData: null,
            vsHistoricalChartOptions: {
                responsive: true,
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
                                display: true,
                                labelString: "Value"
                            }
                        }
                    ]
                }
            },

            vsPast7ChartData: null,
            vsPast7ChartOptions: {
                responsive: true,
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
                                display: true,
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
            countriesAffected: 0,

            countriesList: [],
            selectedCountry: {},

            vsSelectedCountry:'',

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
            countryPosGlobalDeaths: 0,
            countryPosGlobalCases: 0,
            countryPosGlobalRecoveries: 0,

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
            vsCountryPosGlobalCases: 0,
            vsCountryPosGlobalRecoveries: 0,

            worldInfoToggle: false,
            countryInfoToggle: false,
            topInfoToggle: false,
            newsSaToggle: false,
            newsWorldToggle: false,
            addStatsToggle: false,
            countriesCompared:false,

            topDropDownInt: 5,

            sortBy: "deaths"
        };
    },

    mounted() {
        this.getData(this.sortBy);
        setInterval(
            function() {
                this.getData(this.sortBy);
            }.bind(this),
            60000
        );
    },

    methods: {
        getData(sort) {
            (async () => {
                this.countriesData = await covid.getCountry({ sort: sort });
                //World Stats
                this.countriesList = [];
                this.countriesAffected = this.countriesData.length;
                this.countriesData.forEach(element => {
                    this.countriesList.push({
                        name: element.country,
                        flag: element.countryInfo.flag,
                        id: element.countryInfo._id,
                        deaths: element.deaths,
                        cases: element.cases,
                        recovered: element.recovered
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
                this.newsWorld.articles.forEach(article => {
                    this.newsArticlesWorld.push(article);
                });

                //set top countries radar chart
                this.topChartData = {
                    labels: this.getTopLabels(),
                    datasets: [
                        {
                            label: "Deaths",
                            backgroundColor: "#F00",
                            borderColor: "#F00",
                            data: this.getTopDeaths(),
                            fill: false,
                            
                        },
                        {
                            label: "Cases",
                            fill: false,
                            backgroundColor: "#333",
                            borderColor: "#333",
                            data: this.getTopCases()
                        },
                        {
                            label: "Recovered",
                            fill: false,
                            backgroundColor: "#38c172",
                            borderColor: "#38c172",
                            data: this.getTopRecovered()
                        }
                    ]
                };

                let c = this.$cookie.get("country");
                if (c != undefined && c != null) {
                    this.countriesData.forEach(element => {
                        if (element.country.toLowerCase()  == c.toLowerCase() ) {
                            this.selectedCountry.name = c;
                            this.selectedCountry.flag =
                                element.countryInfo.flag;
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

                this.updatedAt = new Date().toString().substr(0, 25);
            })();
        },
        toggleWorldInfo() {
            this.worldInfoToggle = !this.worldInfoToggle;
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
        toggleAddStats() {
            this.addStatsToggle = !this.addStatsToggle;
        },
        onChangeSort(event) {
            this.getData(event.target.value);
            this.sortBy = event.target.value;
        },
        getCountryStats(country) {
            this.countriesData.forEach(element => {
                if (element.country.toLowerCase()  == country.toLowerCase()) {
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
                    this.countryPosGlobalDeaths = this.getCountryPosGlobalDeaths(
                        element.country
                    );
                    this.countryPosGlobalCases = this.getCountryPosGlobalCases(
                        element.country
                    );
                    this.countryPosGlobalRecoveries = this.getCountryPosGlobalRecoveries(
                        element.country
                    );

                    this.historicalChartData = {
                        labels: this.getHistoryLabels(country),
                        datasets: [
                            {
                                label: "Deaths",
                                backgroundColor: "#F00",
                                borderColor: "#F00",
                                data: this.getHistoricalDeaths(country),
                                fill: false
                            },
                            {
                                label: "Cases",
                                fill: false,
                                backgroundColor: "#333",
                                borderColor: "#333",
                                data: this.getHistoricalCases(country)
                            },
                            {
                                label: "Recovered",
                                fill: false,
                                backgroundColor: "#38c172",
                                borderColor: "#38c172",
                                data: this.getHistoricalRecovered(country)
                            }
                        ]
                    };

                    this.past7ChartData = {
                        labels: this.historicalChartData.labels.slice(
                            this.historicalChartData.labels.length - 7
                        ),
                        datasets: [
                            {
                                label: "Deaths",
                                backgroundColor: "#F00",
                                borderColor: "#F00",
                                data: this.historicalChartData.datasets[0].data.slice(
                                    this.historicalChartData.labels.length - 7
                                ),
                                fill: false
                            },
                            {
                                label: "Cases",
                                fill: false,
                                backgroundColor: "#333",
                                borderColor: "#333",
                                data: this.historicalChartData.datasets[1].data.slice(
                                    this.historicalChartData.labels.length - 7
                                )
                            },
                            {
                                label: "Recovered",
                                fill: false,
                                backgroundColor: "#38c172",
                                borderColor: "#38c172",
                                data: this.historicalChartData.datasets[2].data.slice(
                                    this.historicalChartData.labels.length - 7
                                )
                            }
                        ]
                    };
                }
            });
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
        getHistoryLabels(country) {
            let arr = [];
            this.historicalData.forEach(elem => {
                if (elem.country.toLowerCase() == country.toLowerCase()) {
                    for (let key in elem.timeline.cases) {
                        arr.push(key);
                    }
                }
            });
            return arr;
        },
        getHistoricalDeaths(country) {
            let arr = [];
            this.historicalData.forEach(elem => {
                if (elem.country.toLowerCase() == country.toLowerCase()) {
                    for (let key in elem.timeline.deaths) {
                        arr.push(elem.timeline.deaths[key]);
                    }
                }
            });
            return arr;
        },
        getHistoricalCases(country) {
            let arr = [];
            this.historicalData.forEach(elem => {
                if (elem.country.toLowerCase() == country.toLowerCase()) {
                    for (let key in elem.timeline.cases) {
                        arr.push(elem.timeline.cases[key]);
                    }
                }
            });
            return arr;
        },
        getHistoricalRecovered(country) {
            let arr = [];
            this.historicalData.forEach(elem => {
                if (elem.country.toLowerCase() == country.toLowerCase()) {
                    for (let key in elem.timeline.recovered) {
                        arr.push(elem.timeline.recovered[key]);
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
            dl.sort(function(a, b) {
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
                if (dl[i].name.toLowerCase()  == country.toLowerCase() ) {
                    break;
                } else {
                    pos++;
                }
            }

            return pos;
        },

        getCountryPosGlobalCases(country) {
            let dl = this.countriesList.slice(0);
            dl.sort(function(a, b) {
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
                if (dl[i].name.toLowerCase()  == country.toLowerCase() ) {
                    break;
                } else {
                    pos++;
                }
            }

            return pos;
        },
        getCountryPosGlobalRecoveries(country) {
            let dl = this.countriesList.slice(0);
            dl.sort(function(a, b) {
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
                if (dl[i].name.toLowerCase()  == country.toLowerCase()) {
                    break;
                } else {
                    pos++;
                }
            }

            return pos;
        },
        compareCountries(){
            if(this.vsSelectedCountry == ''){
                alert("Please select a country")
            }else{
                this.countriesCompared = true;
                this.countriesData.forEach(element => {
                if (element.country.toLowerCase() == this.vsSelectedCountry.name.toLowerCase()) {
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
                    this.vsCountryDeathsPerMil = element.deathsPerOneMillion;
                    this.vsCountryPosGlobalDeaths = this.getCountryPosGlobalDeaths(
                        element.country
                    );
                    this.vsCountryPosGlobalCases = this.getCountryPosGlobalCases(
                        element.country
                    );
                    this.vsCountryPosGlobalRecoveries = this.getCountryPosGlobalRecoveries(
                        element.country
                    );

                    this.vsHistoricalChartData = {
                        labels: this.getHistoryLabels(element.country),
                        datasets: [
                            {
                                label: "Deaths",
                                backgroundColor: "#F00",
                                borderColor: "#F00",
                                data: this.getHistoricalDeaths(element.country),
                                fill: false
                            },
                            {
                                label: "Cases",
                                fill: false,
                                backgroundColor: "#333",
                                borderColor: "#333",
                                data: this.getHistoricalCases(element.country)
                            },
                            {
                                label: "Recovered",
                                fill: false,
                                backgroundColor: "#38c172",
                                borderColor: "#38c172",
                                data: this.getHistoricalRecovered(element.country)
                            }
                        ]
                    };

                    this.vsPast7ChartData = {
                        labels: this.vsHistoricalChartData.labels.slice(
                            this.vsHistoricalChartData.labels.length - 7
                        ),
                        datasets: [
                            {
                                label: "Deaths",
                                backgroundColor: "#F00",
                                borderColor: "#F00",
                                data: this.vsHistoricalChartData.datasets[0].data.slice(
                                    this.vsHistoricalChartData.labels.length - 7
                                ),
                                fill: false
                            },
                            {
                                label: "Cases",
                                fill: false,
                                backgroundColor: "#333",
                                borderColor: "#333",
                                data: this.vsHistoricalChartData.datasets[1].data.slice(
                                    this.vsHistoricalChartData.labels.length - 7
                                )
                            },
                            {
                                label: "Recovered",
                                fill: false,
                                backgroundColor: "#38c172",
                                borderColor: "#38c172",
                                data: this.vsHistoricalChartData.datasets[2].data.slice(
                                    this.vsHistoricalChartData.labels.length - 7
                                )
                            }
                        ]
                    };
                }
             })
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

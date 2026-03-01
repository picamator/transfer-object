Test Cases
===========

Data Provider
-------------

Definition Files and Transfer Object generators have been tested against the following APIs:

| File                                                                                                                            | Source                                                                                                               |
|---------------------------------------------------------------------------------------------------------------------------------|----------------------------------------------------------------------------------------------------------------------|
| [nasa-neo-rest-v1-neo-2465633.json](/tests/integration/DefinitionGenerator/data/api-response/nasa-neo-rest-v1-neo-2465633.json) | [NASA Open Api](https://api.nasa.gov/neo/rest/v1/neo/2465633?api_key=DEMO_KEY)                                       |
| [open-weather.json](/tests/integration/DefinitionGenerator/data/api-response/open-weather.json)                                 | [OpenWeather](https://openweathermap.org/current?collection=current_forecast#example_JSON)                           |
| [google-shopping-content.json](/tests/integration/DefinitionGenerator/data/api-response/google-shopping-content.json)           | [Google Content API for Shopping](https://developers.google.com/shopping-content/guides/products/products-api?hl=en) |
| [frankfurter-dev.json](/tests/integration/DefinitionGenerator/data/api-response/frankfurter-dev-v1.json)                        | [Frankfurter - open-source currency data API](https://api.frankfurter.dev/v1/latest)                                 |
| [tagesschau-api-bund-dev.json](/tests/integration/DefinitionGenerator/data/api-response/tagesschau-api-bund-dev-v2.json)        | [Tagesschau API](https://tagesschau.api.bund.dev)                                                                    |
| [genesis-destatis-find.json](/tests/integration/DefinitionGenerator/data/api-response/genesis-destatis-find.json)               | [Statistisches Bundesamt (Destatis)](https://www-genesis.destatis.de/genesisWS/swagger-ui/index.html#/find/findPost) |
| [wero-payment-charges-v1.json](/tests/integration/DefinitionGenerator/data/api-response/wero-payment-charges-v1.json) | [Wero - Digital Payment Wallet](https://developerhub.ppro.com/global-api/docs/wero)                                  |

Scenario
--------

1. Rest API response is used as a blueprint to generate Definition Files
2. Transfer Objects are generated based on Definition Files
3. Transfer Object instance is created with the API response
4. Transfer Object is converted back to the array
5. The converted array is compared with the API response

For all APIs, data are ✅ matched.

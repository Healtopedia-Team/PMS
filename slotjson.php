<?php

$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://my.healtopedia.com/wp-json/wc-appointments/v1/appointments/?per_page=100&page=1",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_COOKIE => "xoo_ml_user_ip_data=%257B%2522ip_address%2522%253A%2522%2522%252C%2522countryCode%2522%253A%2522MY%2522%252C%2522request%2522%253A%2522115.135.168.106%2522%252C%2522status%2522%253A200%252C%2522delay%2522%253A%25222ms%2522%252C%2522credit%2522%253A%2522Some%2520of%2520the%2520returned%2520data%2520includes%2520GeoLite%2520data%2520created%2520by%2520MaxMind%252C%2520available%2520from%2520%253Ca%2520href%253D%2527http%253A%255C%252F%255C%252Fwww.maxmind.com%2527%253Ehttp%253A%255C%252F%255C%252Fwww.maxmind.com%253C%255C%252Fa%253E.%2522%252C%2522city%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522region%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522regionCode%2522%253A%252214%2522%252C%2522regionName%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522areaCode%2522%253A%2522%2522%252C%2522dmaCode%2522%253A%2522%2522%252C%2522countryName%2522%253A%2522Malaysia%2522%252C%2522inEU%2522%253A0%252C%2522euVATrate%2522%253Afalse%252C%2522continentCode%2522%253A%2522AS%2522%252C%2522continentName%2522%253A%2522Asia%2522%252C%2522latitude%2522%253A%25223.175%2522%252C%2522longitude%2522%253A%2522101.6893%2522%252C%2522locationAccuracyRadius%2522%253A%252220%2522%252C%2522timezone%2522%253A%2522Asia%255C%252FKuala_Lumpur%2522%252C%2522currencyCode%2522%253A%2522MYR%2522%252C%2522currencySymbol%2522%253A%2522RM%2522%252C%2522currencySymbol_UTF8%2522%253A%2522RM%2522%252C%2522currencyConverter%2522%253A4.039%257D",
  CURLOPT_HTTPHEADER => [
    "Authorization: Basic Y2tfM2IyODI4NGQ2MzMyNWFlMDUyOTE5ZjI1NmE3Y2NjMzk3ZjA2MTcxZTpjc182YTlkM2NhYzRlMzAxNzVkMzk1YzFiM2YyN2U1YTQ2N2U0OTFmNDlh"
  ],
]);

$curl2 = curl_init();

curl_setopt_array($curl2, [
  CURLOPT_URL => "https://my.healtopedia.com/wp-json/wc-appointments/v1/appointments/?per_page=100&page=2",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_COOKIE => "xoo_ml_user_ip_data=%257B%2522ip_address%2522%253A%2522%2522%252C%2522countryCode%2522%253A%2522MY%2522%252C%2522request%2522%253A%2522115.135.168.106%2522%252C%2522status%2522%253A200%252C%2522delay%2522%253A%25222ms%2522%252C%2522credit%2522%253A%2522Some%2520of%2520the%2520returned%2520data%2520includes%2520GeoLite%2520data%2520created%2520by%2520MaxMind%252C%2520available%2520from%2520%253Ca%2520href%253D%2527http%253A%255C%252F%255C%252Fwww.maxmind.com%2527%253Ehttp%253A%255C%252F%255C%252Fwww.maxmind.com%253C%255C%252Fa%253E.%2522%252C%2522city%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522region%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522regionCode%2522%253A%252214%2522%252C%2522regionName%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522areaCode%2522%253A%2522%2522%252C%2522dmaCode%2522%253A%2522%2522%252C%2522countryName%2522%253A%2522Malaysia%2522%252C%2522inEU%2522%253A0%252C%2522euVATrate%2522%253Afalse%252C%2522continentCode%2522%253A%2522AS%2522%252C%2522continentName%2522%253A%2522Asia%2522%252C%2522latitude%2522%253A%25223.175%2522%252C%2522longitude%2522%253A%2522101.6893%2522%252C%2522locationAccuracyRadius%2522%253A%252220%2522%252C%2522timezone%2522%253A%2522Asia%255C%252FKuala_Lumpur%2522%252C%2522currencyCode%2522%253A%2522MYR%2522%252C%2522currencySymbol%2522%253A%2522RM%2522%252C%2522currencySymbol_UTF8%2522%253A%2522RM%2522%252C%2522currencyConverter%2522%253A4.039%257D",
  CURLOPT_HTTPHEADER => [
    "Authorization: Basic Y2tfM2IyODI4NGQ2MzMyNWFlMDUyOTE5ZjI1NmE3Y2NjMzk3ZjA2MTcxZTpjc182YTlkM2NhYzRlMzAxNzVkMzk1YzFiM2YyN2U1YTQ2N2U0OTFmNDlh"
  ],
]);

$curl3 = curl_init();

curl_setopt_array($curl3, [
  CURLOPT_URL => "https://my.healtopedia.com/wp-json/wc-appointments/v1/appointments/?per_page=100&page=3",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_COOKIE => "xoo_ml_user_ip_data=%257B%2522ip_address%2522%253A%2522%2522%252C%2522countryCode%2522%253A%2522MY%2522%252C%2522request%2522%253A%2522115.135.168.106%2522%252C%2522status%2522%253A200%252C%2522delay%2522%253A%25222ms%2522%252C%2522credit%2522%253A%2522Some%2520of%2520the%2520returned%2520data%2520includes%2520GeoLite%2520data%2520created%2520by%2520MaxMind%252C%2520available%2520from%2520%253Ca%2520href%253D%2527http%253A%255C%252F%255C%252Fwww.maxmind.com%2527%253Ehttp%253A%255C%252F%255C%252Fwww.maxmind.com%253C%255C%252Fa%253E.%2522%252C%2522city%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522region%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522regionCode%2522%253A%252214%2522%252C%2522regionName%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522areaCode%2522%253A%2522%2522%252C%2522dmaCode%2522%253A%2522%2522%252C%2522countryName%2522%253A%2522Malaysia%2522%252C%2522inEU%2522%253A0%252C%2522euVATrate%2522%253Afalse%252C%2522continentCode%2522%253A%2522AS%2522%252C%2522continentName%2522%253A%2522Asia%2522%252C%2522latitude%2522%253A%25223.175%2522%252C%2522longitude%2522%253A%2522101.6893%2522%252C%2522locationAccuracyRadius%2522%253A%252220%2522%252C%2522timezone%2522%253A%2522Asia%255C%252FKuala_Lumpur%2522%252C%2522currencyCode%2522%253A%2522MYR%2522%252C%2522currencySymbol%2522%253A%2522RM%2522%252C%2522currencySymbol_UTF8%2522%253A%2522RM%2522%252C%2522currencyConverter%2522%253A4.039%257D",
  CURLOPT_HTTPHEADER => [
    "Authorization: Basic Y2tfM2IyODI4NGQ2MzMyNWFlMDUyOTE5ZjI1NmE3Y2NjMzk3ZjA2MTcxZTpjc182YTlkM2NhYzRlMzAxNzVkMzk1YzFiM2YyN2U1YTQ2N2U0OTFmNDlh"
  ],
]);

$curl4 = curl_init();

curl_setopt_array($curl4, [
  CURLOPT_URL => "https://my.healtopedia.com/wp-json/wc-appointments/v1/appointments/?per_page=100&page=4",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_COOKIE => "xoo_ml_user_ip_data=%257B%2522ip_address%2522%253A%2522%2522%252C%2522countryCode%2522%253A%2522MY%2522%252C%2522request%2522%253A%2522115.135.168.106%2522%252C%2522status%2522%253A200%252C%2522delay%2522%253A%25222ms%2522%252C%2522credit%2522%253A%2522Some%2520of%2520the%2520returned%2520data%2520includes%2520GeoLite%2520data%2520created%2520by%2520MaxMind%252C%2520available%2520from%2520%253Ca%2520href%253D%2527http%253A%255C%252F%255C%252Fwww.maxmind.com%2527%253Ehttp%253A%255C%252F%255C%252Fwww.maxmind.com%253C%255C%252Fa%253E.%2522%252C%2522city%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522region%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522regionCode%2522%253A%252214%2522%252C%2522regionName%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522areaCode%2522%253A%2522%2522%252C%2522dmaCode%2522%253A%2522%2522%252C%2522countryName%2522%253A%2522Malaysia%2522%252C%2522inEU%2522%253A0%252C%2522euVATrate%2522%253Afalse%252C%2522continentCode%2522%253A%2522AS%2522%252C%2522continentName%2522%253A%2522Asia%2522%252C%2522latitude%2522%253A%25223.175%2522%252C%2522longitude%2522%253A%2522101.6893%2522%252C%2522locationAccuracyRadius%2522%253A%252220%2522%252C%2522timezone%2522%253A%2522Asia%255C%252FKuala_Lumpur%2522%252C%2522currencyCode%2522%253A%2522MYR%2522%252C%2522currencySymbol%2522%253A%2522RM%2522%252C%2522currencySymbol_UTF8%2522%253A%2522RM%2522%252C%2522currencyConverter%2522%253A4.039%257D",
  CURLOPT_HTTPHEADER => [
    "Authorization: Basic Y2tfM2IyODI4NGQ2MzMyNWFlMDUyOTE5ZjI1NmE3Y2NjMzk3ZjA2MTcxZTpjc182YTlkM2NhYzRlMzAxNzVkMzk1YzFiM2YyN2U1YTQ2N2U0OTFmNDlh"
  ],
]);

$curl5 = curl_init();

curl_setopt_array($curl5, [
  CURLOPT_URL => "https://my.healtopedia.com/wp-json/wc-appointments/v1/appointments/?per_page=100&page=5",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_COOKIE => "xoo_ml_user_ip_data=%257B%2522ip_address%2522%253A%2522%2522%252C%2522countryCode%2522%253A%2522MY%2522%252C%2522request%2522%253A%2522115.135.168.106%2522%252C%2522status%2522%253A200%252C%2522delay%2522%253A%25222ms%2522%252C%2522credit%2522%253A%2522Some%2520of%2520the%2520returned%2520data%2520includes%2520GeoLite%2520data%2520created%2520by%2520MaxMind%252C%2520available%2520from%2520%253Ca%2520href%253D%2527http%253A%255C%252F%255C%252Fwww.maxmind.com%2527%253Ehttp%253A%255C%252F%255C%252Fwww.maxmind.com%253C%255C%252Fa%253E.%2522%252C%2522city%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522region%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522regionCode%2522%253A%252214%2522%252C%2522regionName%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522areaCode%2522%253A%2522%2522%252C%2522dmaCode%2522%253A%2522%2522%252C%2522countryName%2522%253A%2522Malaysia%2522%252C%2522inEU%2522%253A0%252C%2522euVATrate%2522%253Afalse%252C%2522continentCode%2522%253A%2522AS%2522%252C%2522continentName%2522%253A%2522Asia%2522%252C%2522latitude%2522%253A%25223.175%2522%252C%2522longitude%2522%253A%2522101.6893%2522%252C%2522locationAccuracyRadius%2522%253A%252220%2522%252C%2522timezone%2522%253A%2522Asia%255C%252FKuala_Lumpur%2522%252C%2522currencyCode%2522%253A%2522MYR%2522%252C%2522currencySymbol%2522%253A%2522RM%2522%252C%2522currencySymbol_UTF8%2522%253A%2522RM%2522%252C%2522currencyConverter%2522%253A4.039%257D",
  CURLOPT_HTTPHEADER => [
    "Authorization: Basic Y2tfM2IyODI4NGQ2MzMyNWFlMDUyOTE5ZjI1NmE3Y2NjMzk3ZjA2MTcxZTpjc182YTlkM2NhYzRlMzAxNzVkMzk1YzFiM2YyN2U1YTQ2N2U0OTFmNDlh"
  ],
]);

$curl6 = curl_init();

curl_setopt_array($curl6, [
  CURLOPT_URL => "https://my.healtopedia.com/wp-json/wc-appointments/v1/appointments/?per_page=100&page=6",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_COOKIE => "xoo_ml_user_ip_data=%257B%2522ip_address%2522%253A%2522%2522%252C%2522countryCode%2522%253A%2522MY%2522%252C%2522request%2522%253A%2522115.135.168.106%2522%252C%2522status%2522%253A200%252C%2522delay%2522%253A%25222ms%2522%252C%2522credit%2522%253A%2522Some%2520of%2520the%2520returned%2520data%2520includes%2520GeoLite%2520data%2520created%2520by%2520MaxMind%252C%2520available%2520from%2520%253Ca%2520href%253D%2527http%253A%255C%252F%255C%252Fwww.maxmind.com%2527%253Ehttp%253A%255C%252F%255C%252Fwww.maxmind.com%253C%255C%252Fa%253E.%2522%252C%2522city%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522region%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522regionCode%2522%253A%252214%2522%252C%2522regionName%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522areaCode%2522%253A%2522%2522%252C%2522dmaCode%2522%253A%2522%2522%252C%2522countryName%2522%253A%2522Malaysia%2522%252C%2522inEU%2522%253A0%252C%2522euVATrate%2522%253Afalse%252C%2522continentCode%2522%253A%2522AS%2522%252C%2522continentName%2522%253A%2522Asia%2522%252C%2522latitude%2522%253A%25223.175%2522%252C%2522longitude%2522%253A%2522101.6893%2522%252C%2522locationAccuracyRadius%2522%253A%252220%2522%252C%2522timezone%2522%253A%2522Asia%255C%252FKuala_Lumpur%2522%252C%2522currencyCode%2522%253A%2522MYR%2522%252C%2522currencySymbol%2522%253A%2522RM%2522%252C%2522currencySymbol_UTF8%2522%253A%2522RM%2522%252C%2522currencyConverter%2522%253A4.039%257D",
  CURLOPT_HTTPHEADER => [
    "Authorization: Basic Y2tfM2IyODI4NGQ2MzMyNWFlMDUyOTE5ZjI1NmE3Y2NjMzk3ZjA2MTcxZTpjc182YTlkM2NhYzRlMzAxNzVkMzk1YzFiM2YyN2U1YTQ2N2U0OTFmNDlh"
  ],
]);

$curl7 = curl_init();

curl_setopt_array($curl7, [
  CURLOPT_URL => "https://my.healtopedia.com/wp-json/wc-appointments/v1/appointments/?per_page=100&page=7",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_COOKIE => "xoo_ml_user_ip_data=%257B%2522ip_address%2522%253A%2522%2522%252C%2522countryCode%2522%253A%2522MY%2522%252C%2522request%2522%253A%2522115.135.168.106%2522%252C%2522status%2522%253A200%252C%2522delay%2522%253A%25222ms%2522%252C%2522credit%2522%253A%2522Some%2520of%2520the%2520returned%2520data%2520includes%2520GeoLite%2520data%2520created%2520by%2520MaxMind%252C%2520available%2520from%2520%253Ca%2520href%253D%2527http%253A%255C%252F%255C%252Fwww.maxmind.com%2527%253Ehttp%253A%255C%252F%255C%252Fwww.maxmind.com%253C%255C%252Fa%253E.%2522%252C%2522city%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522region%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522regionCode%2522%253A%252214%2522%252C%2522regionName%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522areaCode%2522%253A%2522%2522%252C%2522dmaCode%2522%253A%2522%2522%252C%2522countryName%2522%253A%2522Malaysia%2522%252C%2522inEU%2522%253A0%252C%2522euVATrate%2522%253Afalse%252C%2522continentCode%2522%253A%2522AS%2522%252C%2522continentName%2522%253A%2522Asia%2522%252C%2522latitude%2522%253A%25223.175%2522%252C%2522longitude%2522%253A%2522101.6893%2522%252C%2522locationAccuracyRadius%2522%253A%252220%2522%252C%2522timezone%2522%253A%2522Asia%255C%252FKuala_Lumpur%2522%252C%2522currencyCode%2522%253A%2522MYR%2522%252C%2522currencySymbol%2522%253A%2522RM%2522%252C%2522currencySymbol_UTF8%2522%253A%2522RM%2522%252C%2522currencyConverter%2522%253A4.039%257D",
  CURLOPT_HTTPHEADER => [
    "Authorization: Basic Y2tfM2IyODI4NGQ2MzMyNWFlMDUyOTE5ZjI1NmE3Y2NjMzk3ZjA2MTcxZTpjc182YTlkM2NhYzRlMzAxNzVkMzk1YzFiM2YyN2U1YTQ2N2U0OTFmNDlh"
  ],
]);

$curl8 = curl_init();

curl_setopt_array($curl8, [
  CURLOPT_URL => "https://my.healtopedia.com/wp-json/wc-appointments/v1/appointments/?per_page=100&page=8",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_COOKIE => "xoo_ml_user_ip_data=%257B%2522ip_address%2522%253A%2522%2522%252C%2522countryCode%2522%253A%2522MY%2522%252C%2522request%2522%253A%2522115.135.168.106%2522%252C%2522status%2522%253A200%252C%2522delay%2522%253A%25222ms%2522%252C%2522credit%2522%253A%2522Some%2520of%2520the%2520returned%2520data%2520includes%2520GeoLite%2520data%2520created%2520by%2520MaxMind%252C%2520available%2520from%2520%253Ca%2520href%253D%2527http%253A%255C%252F%255C%252Fwww.maxmind.com%2527%253Ehttp%253A%255C%252F%255C%252Fwww.maxmind.com%253C%255C%252Fa%253E.%2522%252C%2522city%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522region%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522regionCode%2522%253A%252214%2522%252C%2522regionName%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522areaCode%2522%253A%2522%2522%252C%2522dmaCode%2522%253A%2522%2522%252C%2522countryName%2522%253A%2522Malaysia%2522%252C%2522inEU%2522%253A0%252C%2522euVATrate%2522%253Afalse%252C%2522continentCode%2522%253A%2522AS%2522%252C%2522continentName%2522%253A%2522Asia%2522%252C%2522latitude%2522%253A%25223.175%2522%252C%2522longitude%2522%253A%2522101.6893%2522%252C%2522locationAccuracyRadius%2522%253A%252220%2522%252C%2522timezone%2522%253A%2522Asia%255C%252FKuala_Lumpur%2522%252C%2522currencyCode%2522%253A%2522MYR%2522%252C%2522currencySymbol%2522%253A%2522RM%2522%252C%2522currencySymbol_UTF8%2522%253A%2522RM%2522%252C%2522currencyConverter%2522%253A4.039%257D",
  CURLOPT_HTTPHEADER => [
    "Authorization: Basic Y2tfM2IyODI4NGQ2MzMyNWFlMDUyOTE5ZjI1NmE3Y2NjMzk3ZjA2MTcxZTpjc182YTlkM2NhYzRlMzAxNzVkMzk1YzFiM2YyN2U1YTQ2N2U0OTFmNDlh"
  ],
]);

$curl9 = curl_init();

curl_setopt_array($curl9, [
  CURLOPT_URL => "https://my.healtopedia.com/wp-json/wc-appointments/v1/appointments/?per_page=100&page=9",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_COOKIE => "xoo_ml_user_ip_data=%257B%2522ip_address%2522%253A%2522%2522%252C%2522countryCode%2522%253A%2522MY%2522%252C%2522request%2522%253A%2522115.135.168.106%2522%252C%2522status%2522%253A200%252C%2522delay%2522%253A%25222ms%2522%252C%2522credit%2522%253A%2522Some%2520of%2520the%2520returned%2520data%2520includes%2520GeoLite%2520data%2520created%2520by%2520MaxMind%252C%2520available%2520from%2520%253Ca%2520href%253D%2527http%253A%255C%252F%255C%252Fwww.maxmind.com%2527%253Ehttp%253A%255C%252F%255C%252Fwww.maxmind.com%253C%255C%252Fa%253E.%2522%252C%2522city%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522region%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522regionCode%2522%253A%252214%2522%252C%2522regionName%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522areaCode%2522%253A%2522%2522%252C%2522dmaCode%2522%253A%2522%2522%252C%2522countryName%2522%253A%2522Malaysia%2522%252C%2522inEU%2522%253A0%252C%2522euVATrate%2522%253Afalse%252C%2522continentCode%2522%253A%2522AS%2522%252C%2522continentName%2522%253A%2522Asia%2522%252C%2522latitude%2522%253A%25223.175%2522%252C%2522longitude%2522%253A%2522101.6893%2522%252C%2522locationAccuracyRadius%2522%253A%252220%2522%252C%2522timezone%2522%253A%2522Asia%255C%252FKuala_Lumpur%2522%252C%2522currencyCode%2522%253A%2522MYR%2522%252C%2522currencySymbol%2522%253A%2522RM%2522%252C%2522currencySymbol_UTF8%2522%253A%2522RM%2522%252C%2522currencyConverter%2522%253A4.039%257D",
  CURLOPT_HTTPHEADER => [
    "Authorization: Basic Y2tfM2IyODI4NGQ2MzMyNWFlMDUyOTE5ZjI1NmE3Y2NjMzk3ZjA2MTcxZTpjc182YTlkM2NhYzRlMzAxNzVkMzk1YzFiM2YyN2U1YTQ2N2U0OTFmNDlh"
  ],
]);

$curl10 = curl_init();

curl_setopt_array($curl10, [
  CURLOPT_URL => "https://my.healtopedia.com/wp-json/wc-appointments/v1/appointments/?per_page=100&page=10",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_COOKIE => "xoo_ml_user_ip_data=%257B%2522ip_address%2522%253A%2522%2522%252C%2522countryCode%2522%253A%2522MY%2522%252C%2522request%2522%253A%2522115.135.168.106%2522%252C%2522status%2522%253A200%252C%2522delay%2522%253A%25222ms%2522%252C%2522credit%2522%253A%2522Some%2520of%2520the%2520returned%2520data%2520includes%2520GeoLite%2520data%2520created%2520by%2520MaxMind%252C%2520available%2520from%2520%253Ca%2520href%253D%2527http%253A%255C%252F%255C%252Fwww.maxmind.com%2527%253Ehttp%253A%255C%252F%255C%252Fwww.maxmind.com%253C%255C%252Fa%253E.%2522%252C%2522city%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522region%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522regionCode%2522%253A%252214%2522%252C%2522regionName%2522%253A%2522Kuala%2520Lumpur%2522%252C%2522areaCode%2522%253A%2522%2522%252C%2522dmaCode%2522%253A%2522%2522%252C%2522countryName%2522%253A%2522Malaysia%2522%252C%2522inEU%2522%253A0%252C%2522euVATrate%2522%253Afalse%252C%2522continentCode%2522%253A%2522AS%2522%252C%2522continentName%2522%253A%2522Asia%2522%252C%2522latitude%2522%253A%25223.175%2522%252C%2522longitude%2522%253A%2522101.6893%2522%252C%2522locationAccuracyRadius%2522%253A%252220%2522%252C%2522timezone%2522%253A%2522Asia%255C%252FKuala_Lumpur%2522%252C%2522currencyCode%2522%253A%2522MYR%2522%252C%2522currencySymbol%2522%253A%2522RM%2522%252C%2522currencySymbol_UTF8%2522%253A%2522RM%2522%252C%2522currencyConverter%2522%253A4.039%257D",
  CURLOPT_HTTPHEADER => [
    "Authorization: Basic Y2tfM2IyODI4NGQ2MzMyNWFlMDUyOTE5ZjI1NmE3Y2NjMzk3ZjA2MTcxZTpjc182YTlkM2NhYzRlMzAxNzVkMzk1YzFiM2YyN2U1YTQ2N2U0OTFmNDlh"
  ],
]);

$response = json_decode(curl_exec($curl));
$response2 = json_decode(curl_exec($curl2));
$response3 = json_decode(curl_exec($curl3));
$response4 = json_decode(curl_exec($curl4));
$response5 = json_decode(curl_exec($curl5));
$response6 = json_decode(curl_exec($curl6));
$response7 = json_decode(curl_exec($curl7));
$response8 = json_decode(curl_exec($curl8));
$response9 = json_decode(curl_exec($curl9));
$response10 = json_decode(curl_exec($curl10));

$err = curl_error($curl);

$merged = array_merge($response, $response2, $response3, $response4, $response5, $response6, $response7, $response7, $response8, $response9, $response10);

$result = json_encode($merged);

curl_close($curl);
curl_close($curl2);
curl_close($curl3);
curl_close($curl4);
curl_close($curl5);
curl_close($curl6);
curl_close($curl7);
curl_close($curl8);
curl_close($curl9);
curl_close($curl10);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $result;
}
?>

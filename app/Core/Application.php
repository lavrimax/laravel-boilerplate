<?php

namespace App\Core;

class Application extends \Illuminate\Foundation\Application
{
    /**
     * @param null $locale_to
     * @return string
     */
    public function getLocalePrefix($locale_to = null)
    {
        $locale = $locale_to ?? self::getLocale();
        return ($locale === config('app.fallback_locale')) ? '' : '/' . $locale;
    }

    /**
     * @return array
     */
    public function getSupportedLocales() : array
    {
        $app_locales = config('app.additional_locales');
        $app_locales[] = config('app.fallback_locale');
        return $app_locales;
    }

    /**
     * If $lang is true then $locale will be set to ISO2 format, for example, "en_GB" will be "en"
     *
     * @param string $locale
     * @param bool $lang = false
     * @return bool
     */
    public function checkLocale(string $locale, $lang = false) : bool
    {
        if ($lang) {
            $locale = substr($locale, 0, 2);
        }
        return in_array($locale, $this->getSupportedLocales());
    }

    /**
     * If $lang is true then $locale will be set to ISO2 format, for example, "en_GB" will be "en"
     *
     * @param string $locale
     * @param bool $lang = false
     * @return string
     */
    public function checkAndGetLocale(string $locale, $lang = false) : string
    {
        if ($lang) {
            $locale = substr($locale, 0, 2);
        }
        if (!in_array($locale, $this->getSupportedLocales())) {
            return $this->getDefaultLocale();
        } else {
            return $locale;
        }
    }

    /**
     * @return string
     */
    public function getDefaultLocale() : string
    {
        return config('app.fallback_locale');
    }

    /**
     * @return array
     */
    public function getAdditionalLocales() : array
    {
        return config('app.additional_locales');
    }
}

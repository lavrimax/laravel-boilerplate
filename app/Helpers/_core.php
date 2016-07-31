<?php

use Illuminate\Support\Facades\App;

function trans_url($locale = null)
{
    if ($locale === null) {
        $locale = App::getDefaultLocale();
    }

    $segments = Request::segments();

    // if first segment already is a locale prefix, remove it
    // to build new url with implode()

    if (isset($segments[0])
        && in_array($segments[0], App::getSupportedLocales())
    ) {
        unset($segments[0]);
    }

    // Construct url taking into account locale prefix

    $localePrefix = App::getLocalePrefix($locale);

    if (empty($segments)) {
        if ($localePrefix === '') {
            // return root slash because locale prefix is empty for default locale
            return '/';
        } else {
            return $localePrefix;
        }
    } else {
        return $localePrefix . '/' . implode('/', $segments);
    }
}
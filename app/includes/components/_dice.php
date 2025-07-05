<?php

/**
 * Returns a HTML string representing a dice section for the given dice number.
 *
 * @param int $dice The number of the dice (e.g. 4, 6, 8, 10, 12, 20, 100).
 * @return string A HTML string representing a dice section.
 */
function getDice(int $dice): string
{
    return '
        <section class="dice__section" aria-labelledby="ttl' . $dice . '">
            <div class="dice__banner" data-banner="' . $dice . '" id="banner' . $dice . '">' . $dice . '</div>
            <h2 class="ttl dice__word" id="ttl' . $dice . '">Dé <span class="number">' . $dice . '</span></h2>
            <button id="dice' . $dice . '" data-dice="' . $dice . '">
                <img class="dice dice--' . $dice . '" src="img/' . $dice . '.png" alt="Dé ' . $dice . ' de JDR">
            </button>
        </section>
        ';
}

<?php
    defined( 'ABSPATH' ) or die();

    function predictor_get_competition_stages() {
        global $wpdb;

        $stages = $wpdb->get_results( "select stage from {$wpdb->prefix}predictor_fixtures group by `stage`" );

        return $stages;
    }

    function predictor_get_fixtures( $stage='' ) {
        global $wpdb;

        if( false === empty( $stage ) ) {
            $fixtures = $wpdb->get_results( "select * from {$wpdb->prefix}predictor_fixtures where `stage` = '". $stage ."'" );
        }
        else {
            $fixtures = $wpdb->get_results( $wpdb->prepare( "select * from {$wpdb->prefix}predictor_fixtures where `match_time` > %s group by `stage`", date('Y-m-d H:m:s') ) );
        }
        
        return $fixtures;
    }

    //Get upcoming fixtures
    function predictor_display_upcoming_fixtures() {
        $fixtures = predictor_get_fixtures();

        if( false === empty( $fixtures ) ) {
        
            $fixture_list = '<table class="o-fixtures">';
            $fixture_list .= '<tr>';
            $fixture_list .= '<th>Stage</th>';
            $fixture_list .= '<th>Home</th>';
            $fixture_list .= '<th></th>';
            $fixture_list .= '<th>Away</th>';
            $fixture_list .= '<th>Kick-Off Time</th>';
            $fixture_list .= '<th>Venue</th>';
            $fixture_list .= '</tr>';

            foreach( $fixtures as $fixture ) {
                $fixture_list .= '<tr>';
                $fixture_list .= '<td class="o-fixtures__stage">'. $fixture->stage .'</td>';
                $fixture_list .= '<td class="o-fixtures__hometeam">'. $fixture->home_team .'</td>';
                $fixture_list .= '<td>v</td>';
                $fixture_list .= '<td class="o-fixtures__awayteam">'. $fixture->away_team .'</td>';
                $fixture_list .= '<td class="o-fixtures__awayteam">'. $fixture->match_time .'</td>';
                $fixture_list .= '<td class="o-fixtures__awayteam">'. $fixture->venue .'</td>';
                $fixture_list .= '</tr>';
            }
            $fixture_list .= '</table>';

        }
        else {
            $fixture_list = '<div class="o-notice o-notice--info">
                        There are no fixtures to display.
                    </div>';
        }

        return $fixture_list;
    }

    //Add Shortcode to display upcoming fixtures
    function predictor_display_fixtures_shortcode( $atts ) {
        $fixtures = predictor_display_upcoming_fixtures();

        return $fixtures;
    }
    add_shortcode( 'fixtures', 'predictor_display_fixtures_shortcode' );
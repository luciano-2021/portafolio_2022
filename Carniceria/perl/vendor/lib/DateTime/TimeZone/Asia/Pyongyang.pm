# This file is auto-generated by the Perl DateTime Suite time zone
# code generator (0.07) This code generator comes with the
# DateTime::TimeZone module distribution in the tools/ directory

#
# Generated from /tmp/rnClxBLdxJ/asia.  Olson data version 2013a
#
# Do not edit this file directly.
#
package DateTime::TimeZone::Asia::Pyongyang;
{
  $DateTime::TimeZone::Asia::Pyongyang::VERSION = '1.57';
}

use strict;

use Class::Singleton 1.03;
use DateTime::TimeZone;
use DateTime::TimeZone::OlsonDB;

@DateTime::TimeZone::Asia::Pyongyang::ISA = ( 'Class::Singleton', 'DateTime::TimeZone' );

my $spans =
[
    [
DateTime::TimeZone::NEG_INFINITY, #    utc_start
59611131420, #      utc_end 1889-12-31 15:37:00 (Tue)
DateTime::TimeZone::NEG_INFINITY, #  local_start
59611161600, #    local_end 1890-01-01 00:00:00 (Wed)
30180,
0,
'LMT',
    ],
    [
59611131420, #    utc_start 1889-12-31 15:37:00 (Tue)
60081751800, #      utc_end 1904-11-30 15:30:00 (Wed)
59611162020, #  local_start 1890-01-01 00:07:00 (Wed)
60081782400, #    local_end 1904-12-01 00:00:00 (Thu)
30600,
0,
'KST',
    ],
    [
60081751800, #    utc_start 1904-11-30 15:30:00 (Wed)
60810188400, #      utc_end 1927-12-31 15:00:00 (Sat)
60081784200, #  local_start 1904-12-01 00:30:00 (Thu)
60810220800, #    local_end 1928-01-01 00:00:00 (Sun)
32400,
0,
'KST',
    ],
    [
60810188400, #    utc_start 1927-12-31 15:00:00 (Sat)
60936420600, #      utc_end 1931-12-31 15:30:00 (Thu)
60810219000, #  local_start 1927-12-31 23:30:00 (Sat)
60936451200, #    local_end 1932-01-01 00:00:00 (Fri)
30600,
0,
'KST',
    ],
    [
60936420600, #    utc_start 1931-12-31 15:30:00 (Thu)
61637554800, #      utc_end 1954-03-20 15:00:00 (Sat)
60936453000, #  local_start 1932-01-01 00:30:00 (Fri)
61637587200, #    local_end 1954-03-21 00:00:00 (Sun)
32400,
0,
'KST',
    ],
    [
61637554800, #    utc_start 1954-03-20 15:00:00 (Sat)
61870752000, #      utc_end 1961-08-09 16:00:00 (Wed)
61637583600, #  local_start 1954-03-20 23:00:00 (Sat)
61870780800, #    local_end 1961-08-10 00:00:00 (Thu)
28800,
0,
'KST',
    ],
    [
61870752000, #    utc_start 1961-08-09 16:00:00 (Wed)
DateTime::TimeZone::INFINITY, #      utc_end
61870784400, #  local_start 1961-08-10 01:00:00 (Thu)
DateTime::TimeZone::INFINITY, #    local_end
32400,
0,
'KST',
    ],
];

sub olson_version { '2013a' }

sub has_dst_changes { 0 }

sub _max_year { 2023 }

sub _new_instance
{
    return shift->_init( @_, spans => $spans );
}



1;


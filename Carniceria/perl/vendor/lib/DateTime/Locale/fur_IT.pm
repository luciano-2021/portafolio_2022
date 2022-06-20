###########################################################################
#
# This file is auto-generated by the Perl DateTime Suite locale
# generator (0.05).  This code generator comes with the
# DateTime::Locale distribution in the tools/ directory, and is called
# generate-from-cldr.
#
# This file as generated from the CLDR XML locale data.  See the
# LICENSE.cldr file included in this distribution for license details.
#
# This file was generated from the source file fur_IT.xml
# The source file version number was 1.17, generated on
# 2009/05/05 23:06:36.
#
# Do not edit this file directly.
#
###########################################################################

package DateTime::Locale::fur_IT;

use strict;
use warnings;
use utf8;

use base 'DateTime::Locale::fur';

sub cldr_version { return "1\.7\.1" }

{
    my $first_day_of_week = "1";
    sub first_day_of_week { return $first_day_of_week }
}

{
    my $glibc_date_format = "\%d\.\ \%m\.\ \%y";
    sub glibc_date_format { return $glibc_date_format }
}

{
    my $glibc_date_1_format = "\%a\ \%b\ \%e\ \%H\:\%M\:\%S\ \%Z\ \%Y";
    sub glibc_date_1_format { return $glibc_date_1_format }
}

{
    my $glibc_datetime_format = "\%a\ \%d\ \%b\ \%Y\ \%T\ \%Z";
    sub glibc_datetime_format { return $glibc_datetime_format }
}

{
    my $glibc_time_format = "\%T";
    sub glibc_time_format { return $glibc_time_format }
}

1;

__END__


=pod

=encoding utf8

=head1 NAME

DateTime::Locale::fur_IT

=head1 SYNOPSIS

  use DateTime;

  my $dt = DateTime->now( locale => 'fur_IT' );
  print $dt->month_name();

=head1 DESCRIPTION

This is the DateTime locale package for Friulian Italy.

=head1 DATA

This locale inherits from the L<DateTime::Locale::fur> locale.

It contains the following data.

=head2 Days

=head3 Wide (format)

  lunis
  martars
  miercus
  joibe
  vinars
  sabide
  domenie

=head3 Abbreviated (format)

  lun
  mar
  mie
  joi
  vin
  sab
  dom

=head3 Narrow (format)

  L
  M
  M
  J
  V
  S
  D

=head3 Wide (stand-alone)

  lunis
  martars
  miercus
  joibe
  vinars
  sabide
  domenie

=head3 Abbreviated (stand-alone)

  lun
  mar
  mie
  joi
  vin
  sab
  dom

=head3 Narrow (stand-alone)

  L
  M
  M
  J
  V
  S
  D

=head2 Months

=head3 Wide (format)

  Zenâr
  Fevrâr
  Març
  Avrîl
  Mai
  Jugn
  Lui
  Avost
  Setembar
  Otubar
  Novembar
  Dicembar

=head3 Abbreviated (format)

  Zen
  Fev
  Mar
  Avr
  Mai
  Jug
  Lui
  Avo
  Set
  Otu
  Nov
  Dic

=head3 Narrow (format)

  Z
  F
  M
  A
  M
  J
  L
  A
  S
  O
  N
  D

=head3 Wide (stand-alone)

  Zenâr
  Fevrâr
  Març
  Avrîl
  Mai
  Jugn
  Lui
  Avost
  Setembar
  Otubar
  Novembar
  Dicembar

=head3 Abbreviated (stand-alone)

  Zen
  Fev
  Mar
  Avr
  Mai
  Jug
  Lui
  Avo
  Set
  Otu
  Nov
  Dic

=head3 Narrow (stand-alone)

  Z
  F
  M
  A
  M
  J
  L
  A
  S
  O
  N
  D

=head2 Quarters

=head3 Wide (format)

  Prin trimestri
  Secont trimestri
  Tierç trimestri
  Cuart trimestri

=head3 Abbreviated (format)

  T1
  T2
  T3
  T4

=head3 Narrow (format)

  1
  2
  3
  4

=head3 Wide (stand-alone)

  Prin trimestri
  Secont trimestri
  Tierç trimestri
  Cuart trimestri

=head3 Abbreviated (stand-alone)

  T1
  T2
  T3
  T4

=head3 Narrow (stand-alone)

  1
  2
  3
  4

=head2 Eras

=head3 Wide

  pdC
  ddC

=head3 Abbreviated

  pdC
  ddC

=head3 Narrow

  pdC
  ddC

=head2 Date Formats

=head3 Full

   2008-02-05T18:30:30 = martars 5 di Fevrâr dal 2008
   1995-12-22T09:05:02 = vinars 22 di Dicembar dal 1995
  -0010-09-15T04:44:23 = sabide 15 di Setembar dal -10

=head3 Long

   2008-02-05T18:30:30 = 5 di Fevrâr dal 2008
   1995-12-22T09:05:02 = 22 di Dicembar dal 1995
  -0010-09-15T04:44:23 = 15 di Setembar dal -10

=head3 Medium

   2008-02-05T18:30:30 = 05/02/2008
   1995-12-22T09:05:02 = 22/12/1995
  -0010-09-15T04:44:23 = 15/09/-010

=head3 Short

   2008-02-05T18:30:30 = 05/02/08
   1995-12-22T09:05:02 = 22/12/95
  -0010-09-15T04:44:23 = 15/09/-10

=head3 Default

   2008-02-05T18:30:30 = 05/02/2008
   1995-12-22T09:05:02 = 22/12/1995
  -0010-09-15T04:44:23 = 15/09/-010

=head2 Time Formats

=head3 Full

   2008-02-05T18:30:30 = 18:30:30 UTC
   1995-12-22T09:05:02 = 09:05:02 UTC
  -0010-09-15T04:44:23 = 04:44:23 UTC

=head3 Long

   2008-02-05T18:30:30 = 18:30:30 UTC
   1995-12-22T09:05:02 = 09:05:02 UTC
  -0010-09-15T04:44:23 = 04:44:23 UTC

=head3 Medium

   2008-02-05T18:30:30 = 18:30:30
   1995-12-22T09:05:02 = 09:05:02
  -0010-09-15T04:44:23 = 04:44:23

=head3 Short

   2008-02-05T18:30:30 = 18:30
   1995-12-22T09:05:02 = 09:05
  -0010-09-15T04:44:23 = 04:44

=head3 Default

   2008-02-05T18:30:30 = 18:30:30
   1995-12-22T09:05:02 = 09:05:02
  -0010-09-15T04:44:23 = 04:44:23

=head2 Datetime Formats

=head3 Full

   2008-02-05T18:30:30 = martars 5 di Fevrâr dal 2008 18:30:30 UTC
   1995-12-22T09:05:02 = vinars 22 di Dicembar dal 1995 09:05:02 UTC
  -0010-09-15T04:44:23 = sabide 15 di Setembar dal -10 04:44:23 UTC

=head3 Long

   2008-02-05T18:30:30 = 5 di Fevrâr dal 2008 18:30:30 UTC
   1995-12-22T09:05:02 = 22 di Dicembar dal 1995 09:05:02 UTC
  -0010-09-15T04:44:23 = 15 di Setembar dal -10 04:44:23 UTC

=head3 Medium

   2008-02-05T18:30:30 = 05/02/2008 18:30:30
   1995-12-22T09:05:02 = 22/12/1995 09:05:02
  -0010-09-15T04:44:23 = 15/09/-010 04:44:23

=head3 Short

   2008-02-05T18:30:30 = 05/02/08 18:30
   1995-12-22T09:05:02 = 22/12/95 09:05
  -0010-09-15T04:44:23 = 15/09/-10 04:44

=head3 Default

   2008-02-05T18:30:30 = 05/02/2008 18:30:30
   1995-12-22T09:05:02 = 22/12/1995 09:05:02
  -0010-09-15T04:44:23 = 15/09/-010 04:44:23

=head2 Available Formats

=head3 d (d)

   2008-02-05T18:30:30 = 5
   1995-12-22T09:05:02 = 22
  -0010-09-15T04:44:23 = 15

=head3 EEEd (d EEE)

   2008-02-05T18:30:30 = 5 mar
   1995-12-22T09:05:02 = 22 vin
  -0010-09-15T04:44:23 = 15 sab

=head3 Hm (H:mm)

   2008-02-05T18:30:30 = 18:30
   1995-12-22T09:05:02 = 9:05
  -0010-09-15T04:44:23 = 4:44

=head3 hm (h:mm a)

   2008-02-05T18:30:30 = 6:30 p.
   1995-12-22T09:05:02 = 9:05 a.
  -0010-09-15T04:44:23 = 4:44 a.

=head3 Hms (H:mm:ss)

   2008-02-05T18:30:30 = 18:30:30
   1995-12-22T09:05:02 = 9:05:02
  -0010-09-15T04:44:23 = 4:44:23

=head3 hms (h:mm:ss a)

   2008-02-05T18:30:30 = 6:30:30 p.
   1995-12-22T09:05:02 = 9:05:02 a.
  -0010-09-15T04:44:23 = 4:44:23 a.

=head3 M (L)

   2008-02-05T18:30:30 = 2
   1995-12-22T09:05:02 = 12
  -0010-09-15T04:44:23 = 9

=head3 Md (d/M)

   2008-02-05T18:30:30 = 5/2
   1995-12-22T09:05:02 = 22/12
  -0010-09-15T04:44:23 = 15/9

=head3 MEd (E d/M)

   2008-02-05T18:30:30 = mar 5/2
   1995-12-22T09:05:02 = vin 22/12
  -0010-09-15T04:44:23 = sab 15/9

=head3 MMd (d/MM)

   2008-02-05T18:30:30 = 5/02
   1995-12-22T09:05:02 = 22/12
  -0010-09-15T04:44:23 = 15/09

=head3 MMM (LLL)

   2008-02-05T18:30:30 = Fev
   1995-12-22T09:05:02 = Dic
  -0010-09-15T04:44:23 = Set

=head3 MMMd (d MMM)

   2008-02-05T18:30:30 = 5 Fev
   1995-12-22T09:05:02 = 22 Dic
  -0010-09-15T04:44:23 = 15 Set

=head3 MMMEd (E d MMM)

   2008-02-05T18:30:30 = mar 5 Fev
   1995-12-22T09:05:02 = vin 22 Dic
  -0010-09-15T04:44:23 = sab 15 Set

=head3 MMMMd (d 'di' MMMM)

   2008-02-05T18:30:30 = 5 di Fevrâr
   1995-12-22T09:05:02 = 22 di Dicembar
  -0010-09-15T04:44:23 = 15 di Setembar

=head3 MMMMEd (E d MMMM)

   2008-02-05T18:30:30 = mar 5 Fevrâr
   1995-12-22T09:05:02 = vin 22 Dicembar
  -0010-09-15T04:44:23 = sab 15 Setembar

=head3 ms (mm:ss)

   2008-02-05T18:30:30 = 30:30
   1995-12-22T09:05:02 = 05:02
  -0010-09-15T04:44:23 = 44:23

=head3 y (y)

   2008-02-05T18:30:30 = 2008
   1995-12-22T09:05:02 = 1995
  -0010-09-15T04:44:23 = -10

=head3 yM (M/yyyy)

   2008-02-05T18:30:30 = 2/2008
   1995-12-22T09:05:02 = 12/1995
  -0010-09-15T04:44:23 = 9/-010

=head3 yMEd (EEE, d/M/yyyy)

   2008-02-05T18:30:30 = mar, 5/2/2008
   1995-12-22T09:05:02 = vin, 22/12/1995
  -0010-09-15T04:44:23 = sab, 15/9/-010

=head3 yMMM (MMM y)

   2008-02-05T18:30:30 = Fev 2008
   1995-12-22T09:05:02 = Dic 1995
  -0010-09-15T04:44:23 = Set -10

=head3 yMMMEd (EEE d MMM y)

   2008-02-05T18:30:30 = mar 5 Fev 2008
   1995-12-22T09:05:02 = vin 22 Dic 1995
  -0010-09-15T04:44:23 = sab 15 Set -10

=head3 yMMMM (LLLL 'dal' y)

   2008-02-05T18:30:30 = Fevrâr dal 2008
   1995-12-22T09:05:02 = Dicembar dal 1995
  -0010-09-15T04:44:23 = Setembar dal -10

=head3 yQ (Q yyyy)

   2008-02-05T18:30:30 = 1 2008
   1995-12-22T09:05:02 = 4 1995
  -0010-09-15T04:44:23 = 3 -010

=head3 yQQQ (QQQ y)

   2008-02-05T18:30:30 = T1 2008
   1995-12-22T09:05:02 = T4 1995
  -0010-09-15T04:44:23 = T3 -10

=head3 yyMM (MM/yy)

   2008-02-05T18:30:30 = 02/08
   1995-12-22T09:05:02 = 12/95
  -0010-09-15T04:44:23 = 09/-10

=head3 yyQ (Q yy)

   2008-02-05T18:30:30 = 1 08
   1995-12-22T09:05:02 = 4 95
  -0010-09-15T04:44:23 = 3 -10

=head3 yyyyMMMM (MMMM y)

   2008-02-05T18:30:30 = Fevrâr 2008
   1995-12-22T09:05:02 = Dicembar 1995
  -0010-09-15T04:44:23 = Setembar -10

=head2 Miscellaneous

=head3 Prefers 24 hour time?

Yes

=head3 Local first day of the week

lunis


=head1 SUPPORT

See L<DateTime::Locale>.

=head1 AUTHOR

Dave Rolsky <autarch@urth.org>

=head1 COPYRIGHT

Copyright (c) 2008 David Rolsky. All rights reserved. This program is
free software; you can redistribute it and/or modify it under the same
terms as Perl itself.

This module was generated from data provided by the CLDR project, see
the LICENSE.cldr in this distribution for details on the CLDR data's
license.

=cut

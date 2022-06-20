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
# This file was generated from the source file ha_Arab_SD.xml
# The source file version number was 1.3, generated on
# 2009/05/05 23:06:36.
#
# Do not edit this file directly.
#
###########################################################################

package DateTime::Locale::ha_Arab_SD;

use strict;
use warnings;
use utf8;

use base 'DateTime::Locale::ha_Arab';

sub cldr_version { return "1\.7\.1" }

{
    my $first_day_of_week = "6";
    sub first_day_of_week { return $first_day_of_week }
}

1;

__END__


=pod

=encoding utf8

=head1 NAME

DateTime::Locale::ha_Arab_SD

=head1 SYNOPSIS

  use DateTime;

  my $dt = DateTime->now( locale => 'ha_Arab_SD' );
  print $dt->month_name();

=head1 DESCRIPTION

This is the DateTime locale package for Hausa Arabic Sudan.

=head1 DATA

This locale inherits from the L<DateTime::Locale::ha_Arab> locale.

It contains the following data.

=head2 Days

=head3 Wide (format)

  لِتِنِنْ
  تَلَتَ
  لَرَبَ
  أَلْحَمِسْ
  جُمَعَ
  أَسَبَرْ
  لَحَدِ

=head3 Abbreviated (format)

  لِت
  تَل
  لَر
  أَلْح
  جُم
  أَسَ
  لَح

=head3 Narrow (format)

  لِت
  تَل
  لَر
  أَلْح
  جُم
  أَسَ
  لَح

=head3 Wide (stand-alone)

  لِتِنِنْ
  تَلَتَ
  لَرَبَ
  أَلْحَمِسْ
  جُمَعَ
  أَسَبَرْ
  لَحَدِ

=head3 Abbreviated (stand-alone)

  لِت
  تَل
  لَر
  أَلْح
  جُم
  أَسَ
  لَح

=head3 Narrow (stand-alone)

  L
  T
  L
  A
  J
  A
  L

=head2 Months

=head3 Wide (format)

  جَنَيْرُ
  ڢَبْرَيْرُ
  مَرِسْ
  أَڢْرِلُ
  مَيُ
  يُونِ
  يُولِ
  أَغُسْتَ
  سَتُمْبَ
  أُكْتوُبَ
  نُوَمْبَ
  دِسَمْبَ

=head3 Abbreviated (format)

  جَن
  ڢَب
  مَر
  أَڢْر
  مَي
  يُون
  يُول
  أَغُ
  سَت
  أُكْت
  نُو
  دِس

=head3 Narrow (format)

  جَن
  ڢَب
  مَر
  أَڢْر
  مَي
  يُون
  يُول
  أَغُ
  سَت
  أُكْت
  نُو
  دِس

=head3 Wide (stand-alone)

  جَنَيْرُ
  ڢَبْرَيْرُ
  مَرِسْ
  أَڢْرِلُ
  مَيُ
  يُونِ
  يُولِ
  أَغُسْتَ
  سَتُمْبَ
  أُكْتوُبَ
  نُوَمْبَ
  دِسَمْبَ

=head3 Abbreviated (stand-alone)

  جَن
  ڢَب
  مَر
  أَڢْر
  مَي
  يُون
  يُول
  أَغُ
  سَت
  أُكْت
  نُو
  دِس

=head3 Narrow (stand-alone)

  J
  F
  M
  A
  M
  Y
  Y
  A
  S
  O
  N
  D

=head2 Quarters

=head3 Wide (format)

  Q1
  Q2
  Q3
  Q4

=head3 Abbreviated (format)

  Q1
  Q2
  Q3
  Q4

=head3 Narrow (format)

  1
  2
  3
  4

=head3 Wide (stand-alone)

  Q1
  Q2
  Q3
  Q4

=head3 Abbreviated (stand-alone)

  Q1
  Q2
  Q3
  Q4

=head3 Narrow (stand-alone)

  1
  2
  3
  4

=head2 Eras

=head3 Wide

  غَبَنِنْ مِلَدِ
  مِلَدِ

=head3 Abbreviated

  غَبَنِنْ مِلَدِ
  مِلَدِ

=head3 Narrow

  غَبَنِنْ مِلَدِ
  مِلَدِ

=head2 Date Formats

=head3 Full

   2008-02-05T18:30:30 = تَلَتَ, 5 ڢَبْرَيْرُ, 2008
   1995-12-22T09:05:02 = جُمَعَ, 22 دِسَمْبَ, 1995
  -0010-09-15T04:44:23 = أَسَبَرْ, 15 سَتُمْبَ, -10

=head3 Long

   2008-02-05T18:30:30 = 5 ڢَبْرَيْرُ, 2008
   1995-12-22T09:05:02 = 22 دِسَمْبَ, 1995
  -0010-09-15T04:44:23 = 15 سَتُمْبَ, -10

=head3 Medium

   2008-02-05T18:30:30 = 5 ڢَب, 2008
   1995-12-22T09:05:02 = 22 دِس, 1995
  -0010-09-15T04:44:23 = 15 سَت, -10

=head3 Short

   2008-02-05T18:30:30 = 5/2/08
   1995-12-22T09:05:02 = 22/12/95
  -0010-09-15T04:44:23 = 15/9/-10

=head3 Default

   2008-02-05T18:30:30 = 5 ڢَب, 2008
   1995-12-22T09:05:02 = 22 دِس, 1995
  -0010-09-15T04:44:23 = 15 سَت, -10

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

   2008-02-05T18:30:30 = تَلَتَ, 5 ڢَبْرَيْرُ, 2008 18:30:30 UTC
   1995-12-22T09:05:02 = جُمَعَ, 22 دِسَمْبَ, 1995 09:05:02 UTC
  -0010-09-15T04:44:23 = أَسَبَرْ, 15 سَتُمْبَ, -10 04:44:23 UTC

=head3 Long

   2008-02-05T18:30:30 = 5 ڢَبْرَيْرُ, 2008 18:30:30 UTC
   1995-12-22T09:05:02 = 22 دِسَمْبَ, 1995 09:05:02 UTC
  -0010-09-15T04:44:23 = 15 سَتُمْبَ, -10 04:44:23 UTC

=head3 Medium

   2008-02-05T18:30:30 = 5 ڢَب, 2008 18:30:30
   1995-12-22T09:05:02 = 22 دِس, 1995 09:05:02
  -0010-09-15T04:44:23 = 15 سَت, -10 04:44:23

=head3 Short

   2008-02-05T18:30:30 = 5/2/08 18:30
   1995-12-22T09:05:02 = 22/12/95 09:05
  -0010-09-15T04:44:23 = 15/9/-10 04:44

=head3 Default

   2008-02-05T18:30:30 = 5 ڢَب, 2008 18:30:30
   1995-12-22T09:05:02 = 22 دِس, 1995 09:05:02
  -0010-09-15T04:44:23 = 15 سَت, -10 04:44:23

=head2 Available Formats

=head3 d (d)

   2008-02-05T18:30:30 = 5
   1995-12-22T09:05:02 = 22
  -0010-09-15T04:44:23 = 15

=head3 EEEd (d EEE)

   2008-02-05T18:30:30 = 5 تَل
   1995-12-22T09:05:02 = 22 جُم
  -0010-09-15T04:44:23 = 15 أَسَ

=head3 Hm (H:mm)

   2008-02-05T18:30:30 = 18:30
   1995-12-22T09:05:02 = 9:05
  -0010-09-15T04:44:23 = 4:44

=head3 hm (h:mm a)

   2008-02-05T18:30:30 = 6:30 P.M.
   1995-12-22T09:05:02 = 9:05 A.M.
  -0010-09-15T04:44:23 = 4:44 A.M.

=head3 Hms (H:mm:ss)

   2008-02-05T18:30:30 = 18:30:30
   1995-12-22T09:05:02 = 9:05:02
  -0010-09-15T04:44:23 = 4:44:23

=head3 hms (h:mm:ss a)

   2008-02-05T18:30:30 = 6:30:30 P.M.
   1995-12-22T09:05:02 = 9:05:02 A.M.
  -0010-09-15T04:44:23 = 4:44:23 A.M.

=head3 M (L)

   2008-02-05T18:30:30 = 2
   1995-12-22T09:05:02 = 12
  -0010-09-15T04:44:23 = 9

=head3 Md (M-d)

   2008-02-05T18:30:30 = 2-5
   1995-12-22T09:05:02 = 12-22
  -0010-09-15T04:44:23 = 9-15

=head3 MEd (E, d-M)

   2008-02-05T18:30:30 = تَل, 5-2
   1995-12-22T09:05:02 = جُم, 22-12
  -0010-09-15T04:44:23 = أَسَ, 15-9

=head3 MMM (LLL)

   2008-02-05T18:30:30 = ڢَب
   1995-12-22T09:05:02 = دِس
  -0010-09-15T04:44:23 = سَت

=head3 MMMd (d MMM)

   2008-02-05T18:30:30 = 5 ڢَب
   1995-12-22T09:05:02 = 22 دِس
  -0010-09-15T04:44:23 = 15 سَت

=head3 MMMEd (E d MMM)

   2008-02-05T18:30:30 = تَل 5 ڢَب
   1995-12-22T09:05:02 = جُم 22 دِس
  -0010-09-15T04:44:23 = أَسَ 15 سَت

=head3 MMMMd (d MMMM)

   2008-02-05T18:30:30 = 5 ڢَبْرَيْرُ
   1995-12-22T09:05:02 = 22 دِسَمْبَ
  -0010-09-15T04:44:23 = 15 سَتُمْبَ

=head3 MMMMEd (E d MMMM)

   2008-02-05T18:30:30 = تَل 5 ڢَبْرَيْرُ
   1995-12-22T09:05:02 = جُم 22 دِسَمْبَ
  -0010-09-15T04:44:23 = أَسَ 15 سَتُمْبَ

=head3 ms (mm:ss)

   2008-02-05T18:30:30 = 30:30
   1995-12-22T09:05:02 = 05:02
  -0010-09-15T04:44:23 = 44:23

=head3 y (y)

   2008-02-05T18:30:30 = 2008
   1995-12-22T09:05:02 = 1995
  -0010-09-15T04:44:23 = -10

=head3 yM (y-M)

   2008-02-05T18:30:30 = 2008-2
   1995-12-22T09:05:02 = 1995-12
  -0010-09-15T04:44:23 = -10-9

=head3 yMEd (EEE, d/M/yyyy)

   2008-02-05T18:30:30 = تَل, 5/2/2008
   1995-12-22T09:05:02 = جُم, 22/12/1995
  -0010-09-15T04:44:23 = أَسَ, 15/9/-010

=head3 yMMM (y MMM)

   2008-02-05T18:30:30 = 2008 ڢَب
   1995-12-22T09:05:02 = 1995 دِس
  -0010-09-15T04:44:23 = -10 سَت

=head3 yMMMEd (EEE, d MMM y)

   2008-02-05T18:30:30 = تَل, 5 ڢَب 2008
   1995-12-22T09:05:02 = جُم, 22 دِس 1995
  -0010-09-15T04:44:23 = أَسَ, 15 سَت -10

=head3 yMMMM (y MMMM)

   2008-02-05T18:30:30 = 2008 ڢَبْرَيْرُ
   1995-12-22T09:05:02 = 1995 دِسَمْبَ
  -0010-09-15T04:44:23 = -10 سَتُمْبَ

=head3 yQ (y Q)

   2008-02-05T18:30:30 = 2008 1
   1995-12-22T09:05:02 = 1995 4
  -0010-09-15T04:44:23 = -10 3

=head3 yQQQ (y QQQ)

   2008-02-05T18:30:30 = 2008 Q1
   1995-12-22T09:05:02 = 1995 Q4
  -0010-09-15T04:44:23 = -10 Q3

=head3 yyQ (Q yy)

   2008-02-05T18:30:30 = 1 08
   1995-12-22T09:05:02 = 4 95
  -0010-09-15T04:44:23 = 3 -10

=head2 Miscellaneous

=head3 Prefers 24 hour time?

Yes

=head3 Local first day of the week

أَسَبَرْ


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

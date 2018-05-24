use strict;
use warnings;

my $sourceDir = "txt";

my @files = (
    'Mannen 500m',
    'Mannen 1000m',
    'Mannen 1500m',
    'Mannen 5km',
    'Mannen 10km',
    'Vrouwen 500m',
    'Vrouwen 1000m',
    'Vrouwen 1500m',
    'Vrouwen 3km',
    'Vrouwen 5km',
);

foreach my $file (@files) {
    my $in;
    if (-e "$file.csv") {
        print "Exists: $file.csv\n";
        next;
    }
    if (!open ($in, '<', "$sourceDir/$file.txt")) {
        print "$!: $file.txt\n";
        next;
    }
    print "$file\n";

    my ($i, @contestants, @laps, @splits, $prevDistance);
    #~ my (@splitTimes, $time);
    while (<$in>) {
        chomp;
        next unless $_;
        if (/^(?:(?<distance>\d+)m|(?<finish>Finish))\s+(?<time>\d+\.\d+)/) {
            my $distance = $+{finish} ? $prevDistance + 400 : $+{distance};
            $prevDistance = $distance;

            push @{$laps[$i]}, $+{time};
            #~ push @{$splitTimes[$i]}, $time += $+{time};
            push @splits, $distance if @contestants == 1;
            $i++;
        } elsif (/^[A-Z]{3}$/) {    # country
            next;
        } elsif (/\d/) {            # rank/pair/lane/no, time/gap/record
            next;
        } elsif (/^Splits/) {       # header
            next;
        } else {
            push @contestants, $_;
            $i = 0;
            #~ $i = $time = 0;
        }
    }
    close $in;

    open (my $out, '>', "$file.csv") || die "$!";
    print $out 'Ronde,', join(',', @contestants), "\n";
    $i = 0;
    foreach (@laps) {
    #~ foreach (@splitTimes) {
        print $out $splits[$i++], ',';
        while (@$_ < @contestants) {
            push @$_, 0;    # missing laps in case of dnf
        }
        print $out join(',', @$_), "\n";
    }
    close $out;
}

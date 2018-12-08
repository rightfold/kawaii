#!/usr/bin/env bash

set -o errexit nounset pipefail

dir="${BASH_SOURCE%/*}"

if [ "x$(whoami)" != "xpostgres" ]; then
    echo "This script must be run as user postgres, not as user $(whoami)."
    exit 1
fi

psql -U postgres < "$dir/phase1.sql"
psql -U postgres -d kawaii < "$dir/phase2.sql"

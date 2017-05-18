#!/bin/bash

IDs=( "nh4" "nh3" "ca" "kh" "mg" "no3" "no2" "po4" "ph" "salt" "sio2" "temp")
KEY="eyJrIjoiVE9yaDFwMkdjbjNNSzd1ZlE3MHJwQllqUDNVajU3MHUiLCJuIjoiZXhwb3J0IiwiaWQiOjF9"
DIR="./images"
URL="https://dash.janbein.de/render/dashboard-solo/db/reefdb?orgId=1&theme=light&width=870&height=300"
TANK="Reefer170"

# Generate measurement-graph's
for ID in "${IDs[@]}"
do
    curl -H "Authorization: Bearer $KEY" "$URL&panelId=1&var-field=$ID&var-tankName=$TANK" > $DIR/$ID.png
done;

# Generate waterchange-graph
curl -H "Authorization: Bearer $KEY" "$URL&panelId=2&var-tankName=$TANK" > $DIR/water.png

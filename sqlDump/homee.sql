

CREATE TABLE `buttons` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `sortId` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `roomId` int(11) NOT NULL,
  `link` varchar(500) NOT NULL,
  `webhook1` varchar(255) NOT NULL,
  `webhook2` varchar(255) NOT NULL,
  `webhook3` varchar(255) NOT NULL,
  `buttonText` varchar(50) NOT NULL
) ;

CREATE TABLE `floors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sortId` int(11) NOT NULL DEFAULT '0'
);


CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `floorId` int(11) NOT NULL,
  `sortId` int(11) NOT NULL DEFAULT '0'
) ;


ALTER TABLE `buttons`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `floors`
--
ALTER TABLE `floors`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für Tabelle `buttons`
--
ALTER TABLE `buttons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT für Tabelle `floors`
--
ALTER TABLE `floors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT für Tabelle `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

<?php

function data_marks() {
    return json_decode(@file_get_contents("http://127.0.0.1:21727/graphql", false, stream_context_create([
        "http" => [
            "method" => "POST",
            "header" => "Content-Type: application/json\r\n" .
                "Token: " . $_COOKIE["nots_session"],
            "content" => json_encode([
                "query" => "{
                    marks {
                        subjects {
                            name,
                            averages {
                                student,
                                studentClass
                            },
                            color,
                            marks {
                                id,
                                title,
                                value,
                                scale,
                                average,
                                coefficient,
                                min,
                                max,
                                date,
                                isAway
                            }
                        }
                        averages {
                            student,
                            studentClass
                        }
                    },
                }"])
            ]
        ])
    ), true);
}

function data_evaluations() {
    return json_decode(file_get_contents("http://127.0.0.1:21727/graphql", false, stream_context_create([
        "http" => [
            "method" => "POST",
            "header" => "Content-Type: application/json\r\n" .
                "Token: " . $_COOKIE["nots_session"],
            "content" => json_encode([
                "query" => "{
                    evaluations {
                        name,
                        teacher,
                        color,
                        evaluations {
                            id,
                            name,
                            date,
                            coefficient,
                            levels {
                                name,
                                value {
                                    short,
                                    long
                                }
                            }
                        }
                    }
                }"])
            ]
        ])
    ), true);
}

function data_timetable() {
    return json_decode(file_get_contents("http://127.0.0.1:21727/graphql", false, stream_context_create([
        "http" => [
            "method" => "POST",
            "header" => "Content-Type: application/json\r\n" .
                "Token: " . $_COOKIE["nots_session"],
            "content" => json_encode([
                "query" => "{
                    timetable (from: \"" . date('Y-m-d', time() - (86400 * 7)) . "\", to: \"" . date('Y-m-d', time() + (86400 * 30)) . "\") {
                        id,
                        from,
                        to,
                        isDetention,
                        hasDuplicate,
                        subject,
                        teacher,
                        room,
                        status,
                        isAway,
                        isCancelled,
                        color,
                        remoteLesson
                    }
                }"])
            ]
        ])
    ), true);
}

function data_timetable_min() {
    return json_decode(file_get_contents("http://127.0.0.1:21727/graphql", false, stream_context_create([
            "http" => [
                "method" => "POST",
                "header" => "Content-Type: application/json\r\n" .
                    "Token: " . $_COOKIE["nots_session"],
                "content" => json_encode([
                    "query" => "{
                    timetable (from: \"" . date('Y-m-d', time() - (86400 * 7)) . "\", to: \"" . date('Y-m-d', time() + (86400 * 7)) . "\") {
                        id,
                        from,
                        to,
                        isDetention,
                        hasDuplicate,
                        subject,
                        teacher,
                        room,
                        status,
                        isAway,
                        isCancelled,
                        color,
                        remoteLesson
                    }
                }"])
            ]
        ])
    ), true);
}

function data_infos() {
    return json_decode(file_get_contents("http://127.0.0.1:21727/graphql", false, stream_context_create([
        "http" => [
            "method" => "POST",
            "header" => "Content-Type: application/json\r\n" .
                "Token: " . $_COOKIE["nots_session"],
            "content" => json_encode([
                "query" => "{
                    infos {
                        id,
                        date,
                        title,
                        author,
                        content,
                        htmlContent,
                        files {
                            id,
                            time,
                            subject,
                            name,
                            url
                        }
                    }
                }"])
            ]
        ])
    ), true);
}

function data_files() {
    return json_decode(file_get_contents("http://127.0.0.1:21727/graphql", false, stream_context_create([
        "http" => [
            "method" => "POST",
            "header" => "Content-Type: application/json\r\n" .
                "Token: " . $_COOKIE["nots_session"],
            "content" => json_encode([
                "query" => "{
                    files {
                        id,
                        time,
                        subject,
                        name,
                        url
                    }
                }"])
            ]
        ])
    ), true);
}

function data_user() {
    return json_decode(file_get_contents("http://127.0.0.1:21727/graphql", false, stream_context_create([
        "http" => [
            "method" => "POST",
            "header" => "Content-Type: application/json\r\n" .
                "Token: " . $_COOKIE["nots_session"],
            "content" => json_encode([
                "query" => "{
                    user {
                        studentClass {
                            name
                        },
                        groups {
                            name
                        },
                        name,
                        establishmentsInfo {
                            name,
                            address,
                            postalCode,
                            postalLabel,
                            city,
                            province,
                            country,
                            website
                        },
                        userSettings {
                            theme
                        }
                    }
                }"])
            ]
        ])
    ), true);
}

function data_params() {
    return json_decode(file_get_contents("http://127.0.0.1:21727/graphql", false, stream_context_create([
        "http" => [
            "method" => "POST",
            "header" => "Content-Type: application/json\r\n" .
                "Token: " . $_COOKIE["nots_session"],
            "content" => json_encode([
                "query" => "{
                    params {
                        navigatorId,
                        version,
                        versionFull,
                        establishment,
                        schoolYear,
                        firstDay,
                        lastDay,
                        sequenceDuration,
                        hasLunch,
                        lunchStart,
                        lunchEnd,
                        workingDays,
                        lunchDays,
                        defaultMarkMax,
                        publicHolidays {
                            name,
                            from,
                            to
                        },
                        title,
                        firstHour,
                        hours {
                            name,
                            count,
                            round
                        },
                        endHours {
                            name,
                            count,
                            round
                        },
                        sequences,
                        periods {
                            name,
                            notationPeriod,
                            from,
                            to
                        },
                        breaks {
                            name,
                            position
                        },
                        acquisitionLevels {
                            count,
                            shortName,
                            color,
                            countsForSuccess,
                            positions {
                                name,
                                count,
                                shortName,
                                shortNameWithPrefix
                            }
                        }
                    }
                }"])
            ]
        ])
    ), true);
}

function data_menu() {
    return json_decode(file_get_contents("http://127.0.0.1:21727/graphql", false, stream_context_create([
        "http" => [
            "method" => "POST",
            "header" => "Content-Type: application/json\r\n" .
                "Token: " . $_COOKIE["nots_session"],
            "content" => json_encode([
                "query" => "{
                    menu (from: \"" . date('Y-m-d', time() - (86400 * 7)) . "\", to: \"" . date('Y-m-d', time() + (86400 * 7)) . "\") {
                        date,
                        meals {
                            name,
                            labels {
                                name
                            }
                        }
                    }
                }"])
            ]
        ])
    ), true);
}

function data_absences() {
    return json_decode(file_get_contents("http://127.0.0.1:21727/graphql", false, stream_context_create([
        "http" => [
            "method" => "POST",
            "header" => "Content-Type: application/json\r\n" .
                "Token: " . $_COOKIE["nots_session"],
            "content" => json_encode([
                "query" => "{
                    absences {
                        absences {
                            id,
                            from,
                            to,
                            justified,
                            solved,
                            hours,
                            reason
                        },
                        delays {
                            id,
                            date,
                            justified,
                            solved,
                            justification,
                            minutesMissed,
                            reason
                        },
                        punishments {
                            id,
                            date,
                            isExclusion,
                            isDuringLesson,
                            homework,
                            circumstances,
                            giver,
                            reason,
                            detention {
                                id,
                                from,
                                to
                            }
                        },
                        other {
                            id,
                            kind,
                            date,
                            giver,
                            comment,
                            subject
                        },
                        totals {
                            subject,
                            hoursAssisted,
                            hoursMissed
                        }
                    }
                }"])
            ]
        ])
    ), true);
}

function data_contents() {
    return json_decode(file_get_contents("http://127.0.0.1:21727/graphql", false, stream_context_create([
        "http" => [
            "method" => "POST",
            "header" => "Content-Type: application/json\r\n" .
                "Token: " . $_COOKIE["nots_session"],
            "content" => json_encode([
                "query" => "{
                    contents (from: \"" . date('Y-m-d', time() - (86400 * 7)) . "\", to: \"" . date('Y-m-d', time() + (86400 * 180)) . "\") {
                        id,
                        subject,
                        teachers,
                        from,
                        to,
                        color,
                        title,
                        description,
                        htmlDescription,
                        files {
                            id,
                            name,
                            url
                        }
                    }
                }"])
            ]
        ])
    ), true);
}

function data_homeworks() {
    return json_decode(file_get_contents("http://127.0.0.1:21727/graphql", false, stream_context_create([
        "http" => [
            "method" => "POST",
            "header" => "Content-Type: application/json\r\n" .
                "Token: " . $_COOKIE["nots_session"],
            "content" => json_encode([
                "query" => "{
                    homeworks (from: \"" . date('Y-m-d', time() - (86400 * 7)) . "\", to: \"" . date('Y-m-d', time() + (86400 * 180)) . "\") {
                        id,
                        description,
                        htmlDescription,
                        subject,
                        givenAt,
                        for,
                        done,
                        color,
                        files {
                            id,
                            name,
                            time,
                            url
                        }
                    }
                }"])
            ]
        ])
    ), true);
}
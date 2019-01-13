def run_instructions(a=0):
    d = e = f = 0

    seen = []
    while True:
        d = e | 65536
        e = 16098955
        while True:
            e += (d & 255)
            e = ((e & 16777215) * 65899) & 16777215
            if (d < 256):
                if (e == a):
                    return a, d, e, f
                if (e in seen):
                    return seen.pop()
                seen.append(e)
                break

            f = 1
            while (f * 256 <= d):
                f += 1
            d = f - 1

print run_instructions()

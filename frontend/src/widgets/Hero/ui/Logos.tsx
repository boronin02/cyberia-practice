import Image from "next/image";
import styles from "./Hero.module.css";

const logos = [
  {
    src: "/hero/logos/gaz.svg",
    alt: "gaz",
    width: 98,
    height: 47,
  },
  {
    src: "/hero/logos/manna.svg",
    alt: "manna",
    width: 123,
    height: 41,
  },
  {
    src: "/hero/logos/itkit.svg",
    alt: "itkit",
    width: 116,
    height: 19,
  },
  {
    src: "/hero/logos/komfortel.svg",
    alt: "komfortel",
    width: 141,
    height: 15,
  },
  {
    src: "/hero/logos/integra.svg",
    alt: "integra",
    width: 141,
    height: 11,
  },
  {
    src: "/hero/logos/dveridoff.svg",
    alt: "dveridoff",
    width: 112,
    height: 21,
  },
  {
    src: "/hero/logos/smart.svg",
    alt: "smart",
    width: 106,
    height: 26,
  },
  //   {
  //     src: "/hero/logos/forkagro.svg",
  //     alt: "forkagro",
  //     width: 122,
  //     height: 25,
  //   },
];

export const Logos = () => {
  console.log("render");
  return (
    <div className={styles.logos}>
      {logos.map((logo) => (
        <Image
          key={logo.alt}
          src={logo.src}
          alt={logo.alt}
          width={logo.width}
          height={logo.height}
        />
      ))}
    </div>
  );
};

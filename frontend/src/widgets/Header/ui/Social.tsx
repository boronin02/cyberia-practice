import Image from "next/image";
import styles from "./Header.module.css";
type handleLogo = {
  isDark: boolean;
};

export const Social = ({ isDark }: handleLogo) => {
  return (
    <>
      {isDark ? (
        <>
          <div className={styles.social}>
            <Image
              alt="tg-logo-white"
              src="/tg-logo-white.svg"
              width={32}
              height={32}
            />
            <Image
              alt="max-logo-white"
              src="/max-logo-white.svg"
              width={32}
              height={32}
            />
            <Image
              alt="vk-logo-white"
              src="/vk-logo-white.svg"
              width={32}
              height={32}
            />
          </div>
        </>
      ) : (
        <>
          <div className={styles.social}>
            <Image alt="tg-logo" src="/tg-logo.svg" width={32} height={32} />
            <Image alt="max-logo" src="/max-logo.svg" width={32} height={32} />
            <Image alt="vk-logo" src="/vk-logo.svg" width={32} height={32} />
          </div>
        </>
      )}
    </>
  );
};
